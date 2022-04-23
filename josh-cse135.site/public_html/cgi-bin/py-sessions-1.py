#!/usr/bin/python3

import os
import cgi

form = cgi.FieldStorage()

name = ""

if os.environ.has_key('HTTP_COOKIE'):
   for cookie in map(strip, split(environ['HTTP_COOKIE'], ';')):
      (key, value ) = split(cookie, '=');
      if key == "username":
         name = value


print("Content-type: text/html\r\n")
print("Set-Cookie:username ="+str(form["username"])+";\r\n\r\n"))


if (name == ""):
    name = form["username"]

print ("<html>")
print ("<head>")
print ("<title>Python Session Page 1 by JOSH!</title>")
print ("</head>")
print ("<body>")
print ("<h1>Python Session Page 1 by JOSH!</h1>")
print ("<p>Your name is: "+ name  +"</p>")
print ("</body>")
print ("</html>")
