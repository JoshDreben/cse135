<?php
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	$json_res = NULL;
	if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST["id"])) {
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			http_response_code(400);
			$json_res["message"] = "Content type must be application/json!";
			echo json_encode($json_res);
			exit();
		}
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(!is_array($decoded)){
			http_response_code(400);
			$json_res["message"] = "JSON was sent malformed!";
			echo json_encode($json_res);
			exit();
		}
		$json_res = $decoded;
	}
	echo json_encode($json_res);
?>