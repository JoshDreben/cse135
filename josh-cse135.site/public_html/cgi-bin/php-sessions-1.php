<?php
	header('Cache-Control: no-cache');

	session_start();

	$name = $_SESSION['username'] || $_POST['username'];
	$_SESSION['username'] = $name;
?>

<html>
<head>
	<title>Session Page 1 by JOSH!</title>
</head>

<body>
	<h1>Session Page 1 by JOSH!</h1>
	<p>Your name is: <?php echo $name ?></p>
</body>
</html>