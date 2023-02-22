#!/usr/bin/python3
# -*- coding:utf-8 -*-

#Pacotes pypi
import paramiko
import mysql.connector
import sys

#Ficheiros python
import settings

def fetch_credentials(host_addr):
    '''
    Fetch credentials from Database.
    '''
    mydb = mysql.connector.connect(host=settings.DB_ADDR, user=settings.DB_USER, password=settings.DB_PASS, database=settings.DBNAME)
    mycursor = mydb.cursor()
    sql = "SELECT Ip_Nome, Username, Pass FROM EQUIPAMENTO WHERE Ip_Nome = %s"
    adr = (host_addr,)
    mycursor.execute(sql, adr)
    equip_data = mycursor.fetchall()


def exec_cmd(host_addr, user, passwd, command, port = "22"):
    try:
        # created client using paramiko
        client = paramiko.SSHClient()

        # here we are loading the system
        # host keys
        client.load_system_host_keys()

        # connecting paramiko using host
        # name and password
        client.connect(host_addr, port, username=user, password=passwd)

        # below line command will actually
        # execute in your remote machine
        (stdin, stdout, stderr) = client.exec_command(command)
        cmd_output = stdout.read()    
    finally:
        client.close()


if(__name__ == "__main__"):
    print(sys.argv[1], sys.argv[2])
