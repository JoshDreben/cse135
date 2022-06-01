<?php
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	$json_res = NULL;
	$con = mysqli_connect("db-mysql-sfo3-98726-do-user-11245821-0.b.db.ondigitalocean.com:25060","doadmin","AVNS_Q91stfvIS6ImiPP","cse135");
    if (mysqli_connect_errno()){
		http_response_code(500);
		$json_res["message"] = "Failed to connect to MySQL: " . mysqli_connect_error();
		echo json_encode($json_res);
		exit();
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET["id"])) {
		// POST REQUEST FOR NEW RECORD
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			mysqli_close($con);
			http_response_code(400);
			$json_res["message"] = "Content type must be application/json!";
			echo json_encode($json_res);
			exit();
		}
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(!is_array($decoded)){
			mysqli_close($con);
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

		if (empty($userAgent) || empty($sid) || empty($language) || empty($accept_cookies) ||
			empty($window_inner_width) || empty($window_inner_height) || empty($window_outer_width) ||
			empty($window_outer_height) || empty($screen_width) || empty($screen_height) ||
			empty($js_enabled) || empty($images_enabled) || empty($css_enabled))
		{
			mysqli_close($con);
			http_response_code(400);
			$json_res = null;
			$json_res["message"] = "Static record missing value/s!";
			echo json_encode($json_res);
			exit();
		}
		
		$sql = "INSERT INTO static(user_agent, sid, language, accept_cookies, window_inner_width, 
		window_inner_height, window_outer_width, window_outer_height, screen_width, screen_height,
		js_enabled, images_enabled, css_enabled)
		VALUES('$userAgent','$sid','$language', '$accept_cookies', '$window_inner_width', '$window_inner_height',
		'$window_outer_width', '$window_outer_height', '$screen_width', '$screen_height', '$js_enabled',
		'$images_enabled', '$css_enabled')";
		$con->query($sql);
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["id"])) {
		// POST REQUEST ON OLD RECORD (not allowed)
		http_response_code(400);
		mysqli_close($con);
		$json_res["message"] = "Only use PUT request method to update a record!";
		echo json_encode($json_res);
		exit();
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!isset($_GET["id"]) || empty($_GET["id"]))) {
		$sql = "SELECT  user_agent, screen_width, screen_height FROM static";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "SELECT  user_agent, screen_width, screen_height FROM static WHERE sid=$id";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;	
	} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "DELETE FROM static WHERE sid=$id";
		$res = $con->query($sql);
		$json_res = $res;
	} else if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET["id"])) {
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			mysqli_close($con);
			http_response_code(400);
			$json_res["message"] = "Content type must be application/json!";
			echo json_encode($json_res);
			exit();
		}
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(!is_array($decoded)){
			mysqli_close($con);
			http_response_code(400);
			$json_res["message"] = "JSON was sent malformed!";
			echo json_encode($json_res);
			exit();
		}

		$json_res = $decoded;
		$userAgent = $json_res["userAgent"];
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

		$id  = $_GET["id"];
		$sql = "UPDATE static SET user_agent='$userAgent', language='$language', accept_cookies='$accept_cookies',
		window_inner_width='$window_inner_width', window_inner_height='$window_inner_height', 
		window_outer_width='$window_outer_width', window_outer_height='$window_outer_height',
		screen_width='$screen_width', screen_height='$screen_height', js_enabled='$js_enabled',
		images_enabled='$images_enabled', css_enabled='$css_enabled' WHERE sid=$id";
		$res = $con->query($sql);
		$json_res = $res;
	} else {
		http_response_code(400);
		$json_res["message"] = "Invalid Request!";
	}

	mysqli_close($con);
	echo json_encode($json_res);
?>