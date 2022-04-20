<?php 
  header('Cache-Control: no-cache, must-revalidate')
?>


<html>
<head>
  <title>PHP Hello World! (by JOSH!)</title>
</head>

<body>
  <h1>PHP Hello World! (by JOSH!)</h1>
  <p>Current Date/Time: <?php echo date('d-m-y h:i:s')?></p>
  <p>IP Address: <?php echo $_SERVER['REMOTE_ADDR'] ?></p>
</body>
</html>
