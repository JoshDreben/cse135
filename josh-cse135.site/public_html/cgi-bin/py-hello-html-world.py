#!/usr/bin/python

from datetime import datetime

print ("Content-type:text/html\r\n\r\n")
print ('<html>')
print ('<head>')
print ('<title>Python Hello World by JOSH!</title>')
print ('</head>')
print ('<body>')
print ('<h2>Python Hello World by JOSH!</h2>')
print ('<p>Date and Time:'+ datetime.now().strftime("%d/%m/%Y %H:%M:%S")+ '</p>')
print ('</body>')
print ('</html>')
