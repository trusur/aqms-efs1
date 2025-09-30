import pymodbus
from pymodbus.client.sync import ModbusSerialClient as ModbusClient
from pymodbus.client.sync import ModbusTcpClient as ModbusTCPClient
from pymodbus.constants import Endian
import sys
import time
import db_connect

db = db_connect.connecting()
if not db:
    print("Error connecting to database")
    sys.exit(1)


def update_sensor_value(sensor_reader_id, pin, sensor_value):
    try:
        cursor = db.cursor()
        cursor.execute(
            "SELECT * FROM sensor_values WHERE sensor_reader_id = {} and pin = {}".format(
                sensor_reader_id, pin
            )
        )
        isExist = cursor.fetchone()
        if isExist:
            cursor.execute(
                "UPDATE sensor_values SET value = '{}' WHERE sensor_reader_id = {} and pin = {}".format(
                    sensor_value, sensor_reader_id, pin
                )
            )
        else:
            cursor.execute(
                "INSERT INTO sensor_values(sensor_reader_id, pin, value) VALUES({}, {}, '{}')".format(
                    sensor_reader_id, pin, sensor_value
                )
            )
        db.commit()
        cursor.close()
    except Exception as e:
        print("Error updating sensor value (rk900_reader.py): ", e)


def main():
    if len(sys.argv) < 2:
        print("Usage: python3 pm_aplhasense_reader.py <id>")
    id = sys.argv[1]
    cursor = db.cursor(dictionary=True)
    cursor.execute(
        "SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = {}".format(id)
    )
    result = cursor.fetchone()
    if not result:
        print("Sensor Reader with id {} not found".format(id))
        return
    cursor.close()
    while True:
        instrument = ModbusClient(
            method="rtu",
            port=result["sensor_code"],
            baudrate=int(result["baud_rate"]),
            timeout=1,
            parity="N",
            stopbits=1,
            bytesize=8,
        )
        isConnect = instrument.connect()
        if not isConnect:
            print("[X] Error connecting to sensor (pm_aplhasense_reader.py)")
            time.sleep(2)
            continue

        response = instrument.read_holding_registers(0, 8, unit=2)
        if response.isError():
            print("Error reading registers")
            time.sleep(2)
            continue

        now = time.strftime("%Y-%m-%d %H:%M:%S")
        try:
            data = response.registers
            # sensor_values = [0]*9
            # sensor_values[0] = "PM2.5_DATA_STAT;{};{}".format(data[0],now)
            # sensor_values[1] = "PM2.5_RAW;{};{}".format(data[1],now)
            # sensor_values[2] = "PM2.5_FILT;{};{}".format(data[2],now)
            # sensor_values[3] = "PM2.5_FINE;{};{}".format(data[3],now)
            # sensor_values[4] = "PM10_DATA_STAT;{};{}".format(data[4],now)
            # sensor_values[5] = "PM10_RAW;{};{}".format(data[5],now)
            # sensor_values[6] = "PM10_FILT;{};{}".format(data[6],now)
            # sensor_values[7] = "PM10_FINE;{};{}".format(data[7],now)
            # sensor_values[8] = "FLOW_RATE;{};{}".format(data[8],now)

            sensor_values = [0] * 8
            sensor_values[0] = "PM2.5_DATA_STAT;{};{}".format(data[0], now)
            sensor_values[1] = "PM2.5_RAW;{};{}".format(data[1], now)
            sensor_values[2] = "PM2.5_FILT;{};{}".format(data[2], now)
            sensor_values[3] = "PM2.5_FINE;{};{}".format(data[3] / 10, now)
            # sensor_values[4] = "PM10_DATA_STAT;{};{}".format(data[4],now)
            sensor_values[4] = "PM10_RAW;{};{}".format(data[4], now)
            sensor_values[5] = "PM10_FILT;{};{}".format(data[5], now)
            sensor_values[6] = "PM10_FINE;{};{}".format(data[6] / 10, now)
            sensor_values[7] = "FLOW_RATE;{};{}".format(data[7] / 100, now)

        except Exception as e:
            print("Error reading sensor values (pm_aplhasense_reader.py): ", e)
            time.sleep(2)
            continue

        for pin in range(0, 8):
            update_sensor_value(id, pin, sensor_values[pin])
        time.sleep(2)


if __name__ == "__main__":
    main()
