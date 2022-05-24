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
	$username = $decoded["user"];
	$sql = "SELECT * FROM user WHERE username='$username' OR email='$username'";
	$res = $con->query($sql);
	$emparray = array();
	while ($row = mysqli_fetch_assoc($res))
	{
		$emparray[] = $row;
	}
	$users = $emparray;
	$userobj["user"] = $username;
	$userobj["pass"] = $decoded["pass"];
	if (empty($users[0]) || !password_verify($decoded["pass"],$users[0]["password"])) {
		$userobj["status"] = 0;
		$userobj["msg"] = "User not found or password is incorrect!";
		echo json_encode($userobj);
		exit();
	}
	$userobj["status"] = 1;
	echo json_encode($userobj);
?>