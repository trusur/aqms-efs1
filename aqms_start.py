from __future__ import print_function
from pymodbus.client.sync import ModbusSerialClient
from pyvantagepro import VantagePro2
import sys
import minimalmodbus
import serial
import serial.rs485
import time
import subprocess
import glob
import db_connect

mydb = db_connect.connecting()
mycursor = mydb.cursor()


def serial_ports():
    if sys.platform.startswith('win'):
        ports = ['COM%s' % (i + 1) for i in range(256)]
    elif sys.platform.startswith('linux') or sys.platform.startswith('cygwin'):
        ports = glob.glob('/dev/tty[A-Za-z]*')
    elif sys.platform.startswith('darwin'):
        ports = glob.glob('/dev/tty.*')
    else:
        raise EnvironmentError('Unsupported platform')

    result = []
    for port in ports:
        try:
            s = serial.Serial(port)
            s.close()
            result.append(port)
        except (OSError, serial.SerialException):
            pass
    return result


def check_as_arduino(port):
    COM = serial.Serial()
    COM.port = port
    COM.baudrate = 9600
    COM.timeout = 30
    COM.open()
    retval = str(COM.readline())
    if(retval.count("FS2_ANALYZER") > 0 or retval.count("FS2_ANALYZER_START") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port +
                         "' WHERE driver LIKE 'fs2_analyzer_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        print(" ==> FS2_ANALYZER")

    if(retval.count("FS2_PUMP") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port +
                         "' WHERE driver LIKE 'fs2_pump_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        print(" ==> FS2_PUMP")

    if(retval.count("FS2_PSU") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port +
                         "' WHERE driver LIKE 'fs2_psu_module.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        print(" ==> FS2_PSU")

    if(retval.count("FS2_AUTO_ZERO_VALVE") > 0):
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port +
                         "' WHERE driver LIKE 'fs2_autozerovalve.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        print(" ==> FS2_AUTO_ZERO_VALVE")


def check_as_membrasens(port):
    try:
        rs485 = minimalmodbus.Instrument(port, 1)
        rs485.serial.baudrate = 19200
        rs485.serial.parity = serial.PARITY_EVEN
        rs485.serial.bytesize = 8
        rs485.serial.stopbits = 1
        rs485.mode = minimalmodbus.MODE_RTU
        rs485.serial.timeout = 0.2

        regConcentration = rs485.read_registers(1000, 8, 3)
        mycursor.execute("UPDATE sensor_readers SET sensor_code='" + port +
                         "' WHERE driver LIKE 'fs2_membrasens_v4.py' AND sensor_code='' LIMIT 1")
        mydb.commit()
        print(" ==> FS2_MEMBRASENS_V4")
        return None
    except Exception as e:
        None


def check_as_sds019(serialport):
    try:
        ser = serial.rs485.RS485(port=serialport, baudrate=9600, timeout=3)
        ser.rs485_mode = serial.rs485.RS485Settings(
            rts_level_for_tx=False, rts_level_for_rx=True, delay_before_tx=0.0, delay_before_rx=-0.0)
        ser.timeout = 0.5
        client = ModbusSerialClient(method='rtu')
        client.socket = ser
        client.timeout = 0.5
        client.connect()
        result = client.read_holding_registers(address=0x00B4, count=3, unit=1)
        if(len(result.registers) == 3):
            mycursor.execute("UPDATE sensor_readers SET sensor_code='" + serialport +
                             "' WHERE driver LIKE 'fs2_sds019.py' AND sensor_code='' LIMIT 1")
            mydb.commit()
            print(" ==> FS2_SDS019")

        return None
    except Exception as e:
        None


def check_as_ventagepro2(port):
    try:
        COM_WS = VantagePro2.from_url("serial:%s:%s:8N1" % (port, 19200))
        ws_data = COM_WS.get_current_data()
        WS = ws_data.to_csv(';', False)
        mycursor.execute(
            "UPDATE sensor_readers SET sensor_code='/dev/ttyWS' WHERE driver LIKE 'vantagepro2.py' LIMIT 1")
        mydb.commit()
        print(" ==> VANTAGEPRO2")
    except Exception as e:
        None


#=============================AUTO DETECT SERIAL PORTS=================================
# mycursor.execute("UPDATE sensor_readers SET sensor_code='' WHERE id IN (3,4,5)")
# mydb.commit()
# mycursor.execute("TRUNCATE TABLE serial_ports")
# mydb.commit()

# time.sleep(3)
# for port in serial_ports():
    # print("Adding port " + port)
    # port_desc = ""

    # if sys.platform.startswith('linux') or sys.platform.startswith('cygwin'):
        # p = subprocess.Popen('dmesg | grep ' + str(port).replace('/dev/','') + ' | tail -1', stdout=subprocess.PIPE, shell=True)
        # (output, err) = p.communicate()
        # p_status = p.wait()
        # port_desc = output.decode("utf-8")
        # if "now attached" in port_desc:
            # try:
                # port_desc = port_desc.split(":")[1].split(" now attached")[0]
            # except:
                # port_desc = port_desc

    # print(port_desc)
    # try:
        # mycursor.execute("INSERT INTO serial_ports (port,description) VALUES ('" + port + "','" + port_desc + "')")
        # mydb.commit()
    # except Exception as e:
        # None

# mycursor.execute("SELECT port,description FROM serial_ports ORDER BY port")
# serial_ports = mycursor.fetchall()
# for serial_port in serial_ports:
    # print(serial_port[0])
    # if(str(serial_port[0]).count("ttyUSB") > 0 or str(serial_port[0]).count("ttyACM") > 0 or str(serial_port[0]).count("COM") > 0):
        # check_as_membrasens(serial_port[0])

# mycursor.execute("SELECT id FROM sensor_readers WHERE sensor_code = '" + serial_port[0] + "'")
# try:
    # sensor_reader_id = mycursor.fetchone()[0]
# except Exception as e:
    # sensor_reader_id = ""
# if(str(sensor_reader_id) == ""):
    # check_as_sds019(serial_port[0])

# mycursor.execute("SELECT id FROM sensor_readers WHERE sensor_code = '" + serial_port[0] + "'")
# try:
    # sensor_reader_id = mycursor.fetchone()[0]
# except Exception as e:
    # sensor_reader_id = ""
# if(str(sensor_reader_id) == ""):
    # check_as_ventagepro2(serial_port[0])

# mycursor.execute("SELECT id FROM sensor_readers WHERE sensor_code = '" + serial_port[0] + "'")
# try:
    # sensor_reader_id = mycursor.fetchone()[0]
# except Exception as e:
    # sensor_reader_id = ""
# if(str(sensor_reader_id) == ""):
    # time.sleep(3)
    # check_as_arduino(serial_port[0])

# =============================END AUTO DETECT SERIAL PORTS=================================
mycursor.execute("TRUNCATE sensor_values")
mydb.commit()
mycursor.execute("TRUNCATE measurement_logs")
mydb.commit()


subprocess.Popen("php gui/spark serve > /dev/null 2>&1", shell=True)
time.sleep(1)

mycursor.execute(
    "UPDATE configurations SET content=NOW() WHERE name LIKE 'pump_last'")
mydb.commit()

mycursor.execute(
    "SELECT id,driver FROM sensor_readers WHERE sensor_code <> ''")
sensor_readers = mycursor.fetchall()
for sensor_reader in sensor_readers:
    time.sleep(3)
    command = "python drivers/" + \
        sensor_reader[1] + " " + str(sensor_reader[0])
    if sys.platform.startswith('win') == False:
        command = command.replace("python", "python3")
    subprocess.Popen(command, shell=True)


subprocess.Popen("php gui/spark command:formula_measurement_logs", shell=True)
print("php gui/spark command:formula_measurement_logs")
time.sleep(1)
subprocess.Popen("php gui/spark command:sentdata", shell=True)
print("php gui/spark command:sentdata")
time.sleep(1)
subprocess.Popen("php gui/spark command:sentdata_klhk", shell=True)
print("php gui/spark command:sentdata_klhk")
time.sleep(1)
subprocess.Popen("php gui/spark command:measurement_averaging", shell=True)
print("php gui/spark command:measurement_averaging")
time.sleep(1)
subprocess.Popen("php gui/spark command:zero_calibration", shell=True)
print("php gui/spark command:zero_calibration")
time.sleep(1)
subprocess.Popen("php gui/spark command:task_scheduler", shell=True)
print("php gui/spark command:task_scheduler")

time.sleep(1)
subprocess.Popen("python3 gui_start.py > /dev/null 2>&1", shell=True)
