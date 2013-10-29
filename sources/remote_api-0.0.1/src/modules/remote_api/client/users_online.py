#!/usr/bin/env python
import xmlrpclib
import datetime
import getpass

proxy = xmlrpclib.ServerProxy("http://pc-uli-bs:80/ulicms/ulicms/?remote")

try:
    name = raw_input("Name: ")
    password = getpass.getpass("Passwort: ")
    
    onlineNow = proxy.users.onlinenow(name, password)

    if onlineNow:
        for people in onlineNow:
            print(people)
    else:
        print("Failed")
    
except KeyboardInterrupt:
    pass
