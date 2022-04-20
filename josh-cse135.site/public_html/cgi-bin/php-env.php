<?php

header('Cache-Control: no-cache, must-revalidate');

?>

<html>
<head>
  <title>PHP Environment Variables by JOSH!</title>
</head>

<body>
  <h1>PHP Environment Variables by JOSH!</h1>
  <p>
  <?php
    foreach ($_ENV as $key => $val) {
      echo "{$key}: {$val}";
    }
  ?>
  </p>
</body
</html>
