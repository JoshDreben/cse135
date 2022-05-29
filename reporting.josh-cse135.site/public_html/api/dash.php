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
	
	if (empty($_GET["day_range"])) {
		http_response_code(400);
		$json_res["message"] = "A day range MUST be inputted!";
		echo json_encode($json_res);
		exit();
	}

	$day_range = $_GET["day_range"];
	$sql = "CALL call_dashboard($day_range)";
	$res = $con->query($sql);
	echo $res;
	$emparray = array();
	while ($row = mysqli_fetch_assoc($res))
	{
		$emparray[] = $row;
	}
	$dashboard = $emparray;
	echo json_encode($dashboard);
?>