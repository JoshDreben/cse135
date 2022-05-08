<?php
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	$json_res = NULL;
	$con = mysqli_connect("localhost","admin","CSE135@dmin","cse135");
    if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	//$conn = new mysqli("localhost", "admin", "CSE135@dmin");
	if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET["id"])) {
		// POST REQUEST FOR NEW RECORD
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

		
		$userAgent = $json_res["userAgent"];
		$sid = $json_res["SID"];
		$language = $json_res["language"];
		$accept_cookies = $json_res["acceptCookies"];
		$window_inner_width = $json_res["windowInnerWidth"];
		$window_inner_height = $json_res["windowInnerHeight"];
		$window_outer_width = $json_res["windowOuterWidth"];
		$window_outer_height = $json_res["windowOuterHeight"];
		$screen_width = $json_res["screenWidth"];
		$screen_height = $json_res["screenHeight"];
		$js_enabled = $json_res["jsEnabled"];
		$images_enabled = $json_res["imagesEnabled"];
		$css_enabled = $json_res["cssEnabled"];
		
		$sql = "INSERT INTO static(user_agent, sid, language, accept_cookies, window_inner_width, 
		window_inner_height, window_outer_width, window_outer_height, screen_width, screen_height,
		js_enabled, images_enabled, css_enabled)
		VALUES($userAgent,$sid,$language, $accept_cookies, $window_inner_width, $window_inner_height,
		$window_outer_width, $window_outer_height, $screen_width, $screen_height, $js_enabled,
		$images_enabled, $css_enabled)";
		$con->query($sql);
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["id"])) {
		// POST REQUEST ON OLD RECORD (not allowed)
		http_response_code(400);
		$json_res["message"] = "Only use PUT or PATCH request method to update a record!";
		echo json_encode($json_res);
		exit();
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET["id"])) {
		$json_res = json_decode(file_get_contents("test_db.json"));
	} 
	echo json_encode($json_res);
?>