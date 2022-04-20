<?php

header('Cache-Control: no-cache, must-revalidate');

?>

<html>
<head>
  <title>PHP Environment Variables by JOSH!</title>
</head>

<body>
  <h1>PHP Environment Variables by JOSH!</h1>
  <?php
      echo getenv('APACHE_RUN_DIR');
  ?>
</body>
</html>
