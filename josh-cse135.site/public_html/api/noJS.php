<?php
  header('Content-Type: text/plain');
  $con = mysqli_connect("localhost","admin","CSE135@dmin","cse135");
  $ip = $_SERVER["REMOTE_ADDR"];
  $time = $_SERVER["REQUEST_TIME"];
  $sql = "INSERT INTO no_js(ip_addr, timestamp) VALUES('$ip','$time')";
  $res = $con->query($sql);
  echo "Enable javascript for full functionality of the website!";
?>