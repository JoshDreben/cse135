<?php
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	$json_res = NULL;
	$con = mysqli_connect("localhost","admin","CSE135@dmin","cse135");
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

		$timing = json_decode($json_res["timing"]);
		$load_start = $json_res["loadStart"];
		$load_end = $json_res["loadEnd"];
		$total_load = $json_res["totalLoad"];
		$sid = $json_res["SID"];


		if (empty($timing) || empty($sid) || empty($load_end) || empty($load_start) || empty($total_load))
		{
			mysqli_close($con);
			http_response_code(400);
			$json_res = null;
			$json_res["message"] = "Performance record missing value/s!";
			echo json_encode($json_res);
			exit();
		}
		
		$sql = "INSERT INTO performance(sid, timing, load_start, load_end, total_load)
		VALUES('$sid', '$timing', '$load_start', '$load_end', '$total_load')";
		$con->query($sql);
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["id"])) {
		// POST REQUEST ON OLD RECORD (not allowed)
		http_response_code(400);
		mysqli_close($con);
		$json_res["message"] = "Only use PUT request method to update a record!";
		echo json_encode($json_res);
		exit();
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!isset($_GET["id"]) || empty($_GET["id"]))) {
		$sql = "SELECT * FROM performance";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "SELECT * FROM performance WHERE sid=$id";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;	
	} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "DELETE FROM performance WHERE sid=$id";
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
		$timing = $json_res["timing"];
		$load_start = $json_res["loadStart"];
		$load_end = $json_res["loadEnd"];
		$total_load = $json_res["totalLoad"];
		$sid = $json_res["SID"];

		$id  = $_GET["id"];
		$sql = "UPDATE performance SET timing='$timing', load_start='$load_start', load_end='$load_end', total_load='$total_load'";
		$res = $con->query($sql);
		$json_res = $res;
	} else {
		http_response_code(400);
		$json_res["message"] = "Invalid Request!";
	}

	mysqli_close($con);
	echo json_encode($json_res);
?>