<?php

header('Cache-Control: no-cache, must-revalidate');

$envv = getenv();
?>

<html>
<head>
  <title>PHP Environment Variables by JOSH!</title>
</head>

<body>

  <h1>PHP Environment Variables by JOSH!</h1>
  <h2>Environment Variables:<h2>
  <?php
  foreach ($envv as $key => $value) {
	echo "<p>{$key}: {$value}</p>";
  }
  ?>
  <h2>Server Variables:<h2>
  <?php 
  foreach ($_SERVER  as $key => $value) {
	  echo "<p>{$key}: {$value}</p>";
  }
  ?>
</body>
</html>
