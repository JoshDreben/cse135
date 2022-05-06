<?php
	header('Content-type: application/json');

	if($_SERVER['REQUEST_METHOD'] === 'POST') {

	} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$json_res = json_encode($_REQUEST);
		echo $json_res;	
	} else
?>