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

		$time_entered = $json_res["timeEntered"];
		$time_exited = $json_res["timeExited"];
		$page = $json_res["page"];
		$sid = $json_res["SID"];
		$mouse_coords = $json_res["mouseCoords"];
		$mouse_clicks = $json_res["mouseClicks"];
		$scrolls = $json_res["scrolls"];
		$keys_down = $json_res["keysDown"];
		$keys_up = $json_res["keysUp"];
		$idle_timeouts = $json_res["idleTimeouts"];

		$sql = "INSERT INTO activity(sid, time_entered, time_exited, page, 
							mouse_coords, mouse_clicks, scrolls, keys_down, keys_up, idle_timeouts)
		VALUES('$sid', '$time_entered', '$time_exited', '$page', '$mouse_coords', '$mouse_clicks',
		       '$scrolls', '$keys_down', '$keys_up', '$idle_timeouts')";
		$con->query($sql);
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET["id"])) {
		// POST REQUEST ON OLD RECORD (not allowed)
		http_response_code(400);
		mysqli_close($con);
		$json_res["message"] = "Only use PUT request method to update a record!";
		echo json_encode($json_res);
		exit();
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!isset($_GET["id"]) || empty($_GET["id"]))) {
		$sql = "SELECT * FROM activity";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;
	} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "SELECT * FROM activity WHERE sid=$id";
		$res = $con->query($sql);
		$emparray = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$emparray[] = $row;
		}
		$json_res = $emparray;	
	} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = "DELETE FROM activity WHERE sid=$id";
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
		$time_entered = $json_res["timeEntered"];
		$time_exited = $json_res["timeExited"];
		$sid = $json_res["SID"];
		$mouse_coords = $json_res["mouseCoords"];
		$mouse_clicks = $json_res["mouseClicks"];
		$scrolls = $json_res["scrolls"];
		$keys_down = $json_res["keysDown"];
		$keys_up = $json_res["keysUp"];
		$idle_timeouts = $json_res["idleTimeouts"];

		$id  = $_GET["id"];
		$sql = "UPDATE activity SET time_entered='$time_entered', time_exited='$time_exited', 
									  mouse_coords='$mouse_coords', mouse_clicks='$mouse_clicks',
									  scrolls='$scrolls', keys_down='$keys_down', keys_up='$keys_up', idle_timeouts='$idle_timeouts'
									  WHERE sid=$id";
		$res = $con->query($sql);
		$json_res = $res;
	} else {
		http_response_code(400);
		$json_res["message"] = "Invalid Request!";
	}

	mysqli_close($con);
	echo json_encode($json_res);
?>