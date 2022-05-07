<?php
	header('Content-type: application/json');
	$json_res = NULL;
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			throw new Exception('Content type must be: application/json!');
		}
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(!is_array($decoded)){
			throw new Exception('Received content contained invalid JSON!');
		}

		$json_res = $decoded;
	}
	echo json_encode($json_res);
?>