#!/bin/bash
echo "Reading devices... Please wait!!"
sleep 1s
ls /dev/ttyUSB*
ls /dev/ttyD*
ls /dev/ttyM*
cd ~/aqmsFS2/ && python3 aqms_start.py
$SHELL