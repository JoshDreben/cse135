<?php
header('Cache-control: no-cache');


$name = isset($_SESSION['username']) ? $_SESSION['username'] : $_POST['username'];
$_SESSION['username'] = $name;
?>

<html>
<head>
	<title>PHP Sessions Page 2 by JOSH!</title>
</head>
<body>
	<h1>PHP Sessions Page 2 by JOSH!</h1>
	<p>Your name is: <?php echo $name?></p>
	<a href="./php-sessions-1.php">Session Page 1</a>
	<a href="/php-cgiform.html">PHP Session CGI Form</a>
	<form action="./php-destroy-session.php" method="GET">
		<button type="submit">Destroy Session</button>
	</form>	
</body>
</html>