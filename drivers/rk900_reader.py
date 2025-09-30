import pymodbus
from pymodbus.client.sync import ModbusSerialClient as ModbusClient
from pymodbus.client.sync import ModbusTcpClient as ModbusTCPClient
from pymodbus.constants import Endian
import sys
import time
import struct
import db_connect


db = db_connect.connecting()
if not db:
    print("Error connecting to database")
    sys.exit(1)


def get_float(value1, value2, is_swapped=False):
    try:
        if is_swapped:
            raw_bytes = struct.pack(">HH", value2, value1)
            float_value = struct.unpack(">f", raw_bytes)[0]
        else:
            raw_bytes = struct.pack("<HH", value1, value2)
            float_value = struct.unpack("<f", raw_bytes)[0]
        return round(float_value, 6)
    except Exception as e:
        print(e)
        return None


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
        print("Usage: python3 rk900_reader.py <id>")
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
            parity="E",
            stopbits=1,
            bytesize=8,
        )
        isConnect = instrument.connect()
        if not isConnect:
            print("[X] Error connecting to sensor (rk900_reader.py)")
            time.sleep(2)
            continue

        response = instrument.read_holding_registers(0, 41, unit=1)
        if response.isError():
            print("Error reading registers")

        now = time.strftime("%Y-%m-%d %H:%M:%S")
        try:
            data = response.registers
            sensor_values = [0] * 24

            device_status = data[0]  # 16bit int
            sensor_values[0] = "DEVICE_STATUS;{};{}".format(device_status, now)
            wind_dir = data[1]  # 16bit int
            sensor_values[1] = "WIND_DIR;{};{}".format(wind_dir, now)
            wind_speed = get_float(data[2], data[3])  # 32bit float
            sensor_values[2] = "WIND_SPEED;{};{}".format(wind_speed, now)
            air_temp = get_float(data[4], data[5])  # 32bit float
            sensor_values[3] = "AIR_TEMP;{};{}".format(air_temp, now)
            air_humi = get_float(data[6], data[7])  # 32bit float
            sensor_values[4] = "AIR_HIMIDTY;{};{}".format(air_humi, now)
            air_press = get_float(data[8], data[9])  # 32bit float
            sensor_values[5] = "AIR_PRESSURE;{};{}".format(air_press, now)
            electronic_compass = data[10]  # 16bit int
            sensor_values[6] = "ELECTRONIC_COMPASS;{};{}".format(
                electronic_compass, now
            )
            rain = data[11]  # 16bit int
            sensor_values[7] = "RAIN;{};{}".format(rain, now)
            rain_fall = get_float(data[12], data[13])  # 32bit float
            sensor_values[8] = "RAIN_FALL;{};{}".format(rain_fall, now)
            rain_fall_acc = get_float(data[14], data[15])  # 32bit float
            sensor_values[9] = "RAIN_FALL_ACCUMULATED;{};{}".format(rain_fall_acc, now)
            rain_fall_unit = data[16]  # 16bit int
            sensor_values[10] = "RAIN_FALL_UNIT;{};{}".format(rain_fall_unit, now)
            position = data[17]  # 16bit int
            sensor_values[11] = "POSITION_STATUS;{};{}".format(position, now)
            speed_of_ship = get_float(data[18], data[19])  # 32bit float
            sensor_values[12] = "SPEED_OF_SHIP;{};{}".format(speed_of_ship, now)
            course = data[20]  # 16bit int
            sensor_values[13] = "COURSE;{};{}".format(course, now)
            lat = get_float(data[21], data[22])  # 32bit float
            sensor_values[14] = "LATITUDE;{};{}".format(lat, now)
            lon = get_float(data[23], data[24])  # 32bit float
            sensor_values[15] = "LONGITUDE;{};{}".format(lon, now)
            dust_conc = get_float(data[25], data[26])  # 32bit float
            sensor_values[16] = "DUST_CONCENCTRATION;{};{}".format(dust_conc, now)
            visibility = get_float(data[27], data[28])  # 32bit float
            sensor_values[17] = "VISIBILITY;{};{}".format(visibility, now)
            illuminance = get_float(data[29], data[30])  # 32bit float
            sensor_values[18] = "ILLUMINANCE;{};{}".format(illuminance, now)
            radiation_accu = get_float(data[31], data[32])  # 32bit float
            sensor_values[19] = "RADIATION_ACCUMULATED;{};{}".format(
                radiation_accu, now
            )
            radiation = get_float(data[33], data[34], is_swapped=True)  # 32bit float
            sensor_values[20] = "RADIATION;{};{}".format(radiation, now)
            real_wind_dir = get_float(data[35], data[36])  # 32bit float
            sensor_values[21] = "REAL_WIND_DIRECTION;{};{}".format(real_wind_dir, now)
            altitude = get_float(data[37], data[38])  # 32bit float
            sensor_values[22] = "ALTITUDE;{};{}".format(altitude, now)
            real_wind_speed = get_float(data[39], data[40])  # 32bit float
            sensor_values[23] = "REAL_WIND_SPEED;{};{}".format(real_wind_speed, now)

            for pin, sensor_value in enumerate(sensor_values):
                # print("PIN: {} - {}".format(pin, sensor_value))
                update_sensor_value(id, pin, sensor_value)

            instrument.close()
        except Exception as e:
            print("Error reading sensor values (rk900_reader.py): ", e)
            instrument.close()
        time.sleep(2)


if __name__ == "__main__":
    main()
