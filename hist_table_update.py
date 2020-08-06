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

tableid = 1314

sql = "SELECT * FROM monitor_data WHERE ID = " + str(tableid) + " OR ParentID =" + str(tableid) + ";"

mycursor.execute(sql)

desc = mycursor.description
column_names = [col[0] for col in desc]
data = [dict(zip(column_names, row))
        for row in mycursor.fetchall()]
output_data = []

for i in data:
  x = {}
  if int(i["ID"]) == int(tableid):
    x["AChannel"] = int(i["PM2_5Value"])
  if int(i["ID"]) != int(tableid) & int(i["ParentID"]) == int(tableid):
    x["BChannel"] = int(i["PM2_5Value"])
    
  x["lastModified"] = i["lastModified"]
  print("Appending %s", x)
  output_data.append(x)

"""for i in data:
  x = {}
  channelstatus = 'null'
  if int(i["ID"]) == int(tableid):
    x["AChannel"] = int(i["PM2_5Value"])
    print("Is Parent")
    channelstatus == 'A'
  elif int(i["ID"]) != int(tableid) & int(i["ParentID"]) == int(tableid):
    x["BChannel"] = int(i["PM2_5Value"])
    print("Is Child")
    channelstatus == 'B'
  x["lastModified"] = i["lastModified"]

  for b in data:
    print("Timestamp comparison:", b["lastModified"], x["lastModified"])
    if str(b["lastModified"]) == str(x["lastModified"]):
      if channelstatus == 'B':
        x["AChannel"] = int(b["PM2_5Value"])
        print("Adding B Channel to Parent")
      elif channelstatus == 'A':
        x["BChannel"] = int(b["PM2_5Value"])
        print("Adding A Chennel to Child")"""

  print("Appending: ", x)
  output_data.append(x)

#print(output_data)