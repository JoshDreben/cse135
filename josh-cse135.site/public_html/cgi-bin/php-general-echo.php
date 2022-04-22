<?php
header('Cache-control: no-cache');

$query = $_SERVER['QUERY_STRING'];

?>
<html>
<head>
	<title>PHP General Request Echo by JOSH!</title>
</head>
<body>
	<h1>PHP General Request Echo by JOSH!</h1>
	<p>Protocol: <?php  echo getenv('SERVER_PROTOCOL') ?></p>
	<p>Request Method: <?php  echo getenv('REQUEST_METHOD') ?></p>
	<p>Query String: <?php  echo $query ?></p>
	<p> Message Body:</p>
	<?php
		foreach ($_REQUEST as $key => $value) {
			echo "<p>{$key}: {$value}</p>";
		}
	?>
</body>
</html>