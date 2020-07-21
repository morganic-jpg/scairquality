import sys
import json
import mysql.connector
from datetime import datetime

mydb = mysql.connector.connect(
    host="localhost",
    user="airdata",
    passwd="AESl0uis!",
    database="airdata"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT name, address FROM customers")

myresult = mycursor.fetchall()

for x in myresult:
  print(x)