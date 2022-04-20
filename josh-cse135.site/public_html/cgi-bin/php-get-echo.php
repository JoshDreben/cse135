<?php
header('Cache-Control: no-cache, must-revalidate');

$query = $_SERVER['QUERY_STRING'];

?>
<html>
<head>
	<title>PHP Get Request Echo by JOSH!</title>
</head>
<body>
	<h1>PHP Get Request Echo by JOSH!</h1>
	<p>Query String: <?php  echo $query ?></p>
	<?php
		foreach ($_GET as $key => $value) {
			echo "<p>{$key}: {$value}</p>";
		}
	?>
</body>
</html>