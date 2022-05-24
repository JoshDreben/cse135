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

		
		$username = $json_res["user"];
		$password = password_hash($json_res["pass"], PASSWORD_DEFAULT);

		if(empty($username) || empty($json_res["pass"]))
		{
			mysqli_close($con);
			http_response_code(400);
			$json_res = null;
			$json_res["message"] = "User record missing value/s!";
			echo json_encode($json_res);
			exit();
		}
		
		$sql = "INSERT INTO user(username, password) VALUES('$username', '$password')";
		$con->query($sql);
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["id"])) {
		// POST REQUEST ON OLD RECORD (not allowed)
		http_response_code(400);
		mysqli_close($con);
		$json_res["message"] = "Only use PUT request method to update a record!";
		echo json_encode($json_res);
		exit();
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!isset($_GET["id"]) || empty($_GET["id"]))) {
		$sql = "SELECT * FROM user";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "SELECT * FROM user WHERE id=$id";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;	
	} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "DELETE FROM user WHERE id=$id";
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
		$username = $json_res["user"];
		$password = password_hash($json_res["pass"], PASSWORD_DEFAULT);
		$id  = $_GET["id"];
		$sql = "UPDATE user SET username='$username', password='$password'";
		$res = $con->query($sql);
		$json_res = $res;
	} else {
		http_response_code(400);
		$json_res["message"] = "Invalid Request!";
	}

	mysqli_close($con);
	echo json_encode($json_res);
?>