<?php
	header('Content-type: application/json');
	$json_res = NULL;
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			http_response_code(400);
			exit("Content type must be application/json!");
		}
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(!is_array($decoded)){
			http_response_code(400);
			exit("JSON body is malformed!");
		}

		$json_res = $decoded;
	}
	echo json_encode($json_res);
?>