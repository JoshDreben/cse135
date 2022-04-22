<?php
	header('Cache-control: no-cache');
	setcookie (session_id(), "", time()-3600);
	session_destroy();
	session_write_close();
?>

<html>
<head>
	<title>PHP Session Destroyed by JOSH!</title>
</head>
<body>
	<h1>PHP Session Destroyed by JOSH!</h1>
	<a href="/php-cgiform.html">Back to the PHP Form!</a>
</body>
</html>