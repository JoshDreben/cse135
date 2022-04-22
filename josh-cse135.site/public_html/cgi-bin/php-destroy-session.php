<?php
	header('Cache-control: no-cache');
	$params = session_get_cookie_params();
	setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
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