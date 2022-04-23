#!/usr/bin/python3
import os
import cgi


name = ""
if "HTTP_COOKIE" in os.environ:
    http_cook = 1
    for cookie in map(str.strip, str.split(os.environ["HTTP_COOKIE"], ';')):
      (key, value ) = str.split(cookie, '=');
      if key == "username":
         name = value

print("Cache-control: no-cache")
print("Content-type: text/html\r\n\r\n")



print ("<html>")
print ("<head>")
print ("<title>Python Session Page 2 by JOSH!</title>")
print ("</head>")
print ("<body>")
print ("<h1>Python Session Page 2 by JOSH!</h1>")
print ("<p>Your name is: "+ name +"</p>")
print ('<a href="./py-sessions-1.py">Session Page 1</a>')
print ('<a href="/py-cgiform.html">Python Session CGI Form</a>')
print ('<form action="./py-destroy-session.py" method="GET">')
print ('<button type="submit">Destroy Session</button>')
print ('</form>')
print ("</body>")
print ("</html>")
