#!/usr/bin/env python
import xmlrpclib
import datetime
import getpass

proxy = xmlrpclib.ServerProxy("http://pc-uli-bs:80/ulicms/ulicms/?remote")

try:
    name = raw_input("Name: ")
    password = getpass.getpass("Passwort: ")
    
    modules = proxy.modules.list(name, password)

    if modules:
        for m in modules:
            print(m)
    else:
        print("Failed")
    
except KeyboardInterrupt:
    pass
