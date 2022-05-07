<?php
	header('Content-type: application/json');
	$json_res = NULL;
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		foreach ($_POST as $key => $value)
		{
			//$json_res[$key] = $value;	
			$json_res["METHOD"] = "POST";
		}
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$json_res = json_encode($_REQUEST);
	} 

	$json_res = json_encode($json_res);
	echo $json_res;
?>