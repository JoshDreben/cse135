#!/usr/bin/python3

import cgi, cgitb 

form = cgi.FieldStorage() 


print ("Content-type:text/html\r\n\r\n")
print ("<html>")
print ("<head>")
print ("<title>Python Get Echo by JOSH!</title>")
print ("</head>")
print ("<body>")
print ("<h1>Get Echo by JOSH!</h1>")
for key in form.keys():
    print ("<p>" + str(key) + ": " + str(form[str(key)]) + "</p>")
print ("</body>")
print ("</html>")
