<?php
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	$json_res = NULL;
	$mysqli = new mysqli("db-mysql-sfo3-98726-do-user-11245821-0.b.db.ondigitalocean.com:25060","doadmin","AVNS_Q91stfvIS6ImiPP","cse135");
	if ($mysqli->connect_errno){
		http_response_code(500);
		$json_res["message"] = "Failed to connect to MySQL: " . mysqli_connect_error();
		echo json_encode($json_res);
		exit();
	}
	
	if (empty($_GET["day_range"])) {
		http_response_code(400);
		$json_res["message"] = "A day range MUST be inputted!";
		echo json_encode($json_res);
		exit();
	}

	$day_range = $_GET["day_range"];
	$sql = "CALL call_dashboard($day_range)";
	$stmt = $mysqli->prepare($sql);
	$stmt->execute();
	$emparray = array();
	$res = $mysqli->use_result();
	while ($row = mysqli_fetch_assoc($res))
	{
		$emparray[] = $row;
		$res->close();
	}
	$dashboard = $emparray;
	$json_res["dash"] = $dashboard;
	$emparray = arrary();
	$res = $con->use_result();
	while ($row = mysqli_fetch_assoc($res))
	{
		$emparray[] = $row;
		$res->close();
	}
	$activity = $emparray;
	$json_res["activity"] = $activity;
	$mysqli->close();
	echo json_encode($json_res);
?>