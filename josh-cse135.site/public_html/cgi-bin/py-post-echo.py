#!/usr/bin/python3

import cgi
import os

form = cgi.FieldStorage()


print ("Content-type:text/html\r\n\r\n")
print ("<html>")
print ("<head>")
print ("<title>Python POST Echo by JOSH!</title>")
print ("</head>")
print ("<body>")
print ("<h1>POST Echo by JOSH!</h1>")
print ("<p>Message Body: </p>")
for key in form.keys():
    print ("<p>" + str(key) + ": " + str(form[str(key)].value) + "</p>")
print ("</body>")
print ("</html>")
