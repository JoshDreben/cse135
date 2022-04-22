<?php
	header('Cache-control: no-cache');

	session_start();

	$name = isset($_SESSION['username']) ? $_SESSION['username'] : $_POST['username'];
	$_SESSION['username'] = $name;
?>

<html>
<head>
	<title>Session Page 1 by JOSH!</title>
</head>

<body>
	<h1>Session Page 1 by JOSH!</h1>
	<p>Your name is: <?php echo $name ?></p>
	<a href="./php-sessions-2.php">Session Page 2</a>
	<a href="/php-cgiform.html">PHP Session CGI Form</a>
	<form action="./php-destroy-session.php" method="GET">
		<button type="submit">Destroy Session</button>
	</form>
</body>
</html>