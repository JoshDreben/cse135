#!/usr/bin/python3

from datetime import datetime
import os
import html

print ("Content-type:application/json\r\n\r\n")
print ('{"title": "Python JSON by JOSH!", "message": "Hello from PYTHON JSON by JOSH!", "Date": "' + str(datetime.now()) + '", "IP Address": "'+str(html.escape(os.environ["REMOTE_ADDR"]+'"}')))
