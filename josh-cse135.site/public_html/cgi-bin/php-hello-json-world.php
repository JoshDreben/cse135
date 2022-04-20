<?php

header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json');
$helloObj->title = "PHP Hello World! (by JOSH!)";
$helloObj->message = "PHP Hello World! (by JOSH!)";
$helloObj->date = date('d-m-y h:i:s');
$helloObj->ip_address = $_SERVER['REMOTE_ADDR'];

$myJSON = json_encode($helloObj);
echo $myJSON;
?>
