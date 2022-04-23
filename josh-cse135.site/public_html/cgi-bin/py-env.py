#!/usr/bin/python

import os

print ("Content-type: text/html\n\n");

print ("<html>")
print ("<head>")
print ("<title>Python Environment by JOSH!</title>");
print ("</head>")
print ("<body>")
print ("<h1>Python Environment by JOSH!</h1><\br>")
for param in os.environ.keys():
   print ("<b>%20s</b>: %s<\br>" % (param, os.environ[param]))
print ("</body>")
print ("</html>")
