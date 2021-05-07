import sys
import json
import requests
import mysql.connector
from datetime import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="airdata",
  passwd="AESl0uis!",
  database="airdata"
)

mycursor = mydb.cursor()

# opens JSON file as a readable string and assigns the
# region list to a variable
monitor_list = open("/home/legal-server/python_code/monitor_list.json", "r")
region_list = json.loads(monitor_list.read())
ID_list = region_list["Regions"]

# concatenates all monitor ids from the region list into one variable
# for every ID in each region add another ID equal to the original
# ID plus 1 (This is the B channel for each monitor)
total_ids = [i["Stations"] for i in ID_list]

print(total_ids)

for tableid in total_ids:
  sql_del = "DROP TABLE IF EXISTS sensor" + str(tableid) + ";"
  mycursor.execute(sql_del)
