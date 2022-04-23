#!/usr/bin/python3
import os
import cgi

form = cgi.FieldStorage()


print("Cache-control: no-cache")
print("Set-Cookie:username =;Path=/;Expires = Thu, 01 Jan 1970 00:00:00 GMT")
print("Content-type: text/html\n\n")



print ("<html>")
print ("<head>")
print ("<title>Python Destroy Session Page by JOSH!</title>")
print ("</head>")
print ("<body>")
print ("<h1>Python Destroy Session Page by JOSH!</h1>")
print ('<a href="./py-sessions-1.py">Session Page 1</a>')
print ('<a href="/py-cgiform.html">Python Session CGI Form</a>')
print ("</body>")
print ("</html>")
