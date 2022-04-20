<?php

header('Cache-Control: no-cache, must-revalidate');

?>

<html>
<head>
  <title>PHP Environment Variables by JOSH!</title>
</head>

<body>
  <h1>PHP Environment Variables by JOSH!</h1>
  <p>APACHE_RIN_DIR: <?php echo getenv('APACHE_RUN_DIR');?></p>
  <p>APACHE_PID_FILE: <?php echo getenv('APACHE_PID_FILE');?></p>
  <p>JOURNAL_STREAM: <?php echo getenv('JOURNAL_STREAM');?></p>
  <p>PATH: <?php echo getenv('PATH');?></p>
  <p>INVOCATION_ID: <?php echo getenv('INVOCATION_ID');?></p>
  <p>APACHE_LOCK_DIR: <?php echo getenv('APACHE_LOCK_DIR');?></p>
  <p>LANG: <?php echo getenv('LANG');?></p>
  <p>APACHE_RUN_USER: <?php echo getenv('APACHE_RUN_USER');?></p>
  <p>APACHE_LOG_DIR: <?php echo getenv('APACHE_LOG_DIR');?></p>
  <p>PWD: <?php echo getenv('PWD');?></p>
  <?php 
  foreach ($_SERVER  as $key => $value) {
	  echo "{$key}: {$value}";
  }
  ?>
</body>
</html>
