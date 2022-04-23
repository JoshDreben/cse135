#!/usr/bin/python

from datetime import datetime
import os
import cgi

print ("Content-type:application/json\r\n\r\n")
print ('{"title": "Python JSON by JOSH!", "message": "Hello from PYTHON JSON by JOSH!", "Date": "' + str(datetime.now()) + '", "IP Address": "'+str(cgi.escape(os.environ["REMOTE_ADDR"]+'"}')))
