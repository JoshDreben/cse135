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
    foreach ($_ENV as $key => $val) {
      echo "<p>{$key}: {$val}</p>";
    }
  ?>
</body>
</html>
