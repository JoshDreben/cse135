<?php
  header('Content-Type: application/json');
  $con = mysqli_connect("localhost","admin","CSE135@dmin","cse135");
  $ip = $_SERVER["REMOTE_ADDR"];
  $sql = "INSERT INTO no_js(ip_addr) VALUES('$ip')";
  $res = $con->query($sql);
  echo "Enable javascript for full functionality of the website!";
?>