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
    foreach ($_ENV as $e){
      echo `<p>$_e</p>`;
    }
  ?>
</body
</html>
