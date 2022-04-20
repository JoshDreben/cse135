<?php
header('Cache-Control: no-cache, must-revalidate');

?>
<html>
<head>
	<title>PHP Get Request Echo by JOSH!</title>
</head>
<body>
	<h1>PHP Get Request Echo by JOSH!</h1>
	<p>Message Body:</p>
	<?php
		foreach ($_POST as $key => $value) {
			echo "<p>{$key}: {$value}</p>";
		}
	?>
</body>
</html>