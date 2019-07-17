<?php 
	
	$conn = new mysqli("localhost", "root", "", "vue-ecom");
	if ($conn->connect_error) {
		die("Database Could not Connected.");
	}


	$res = array('error' => false);

	$action= 'login';

 
	if (isset($_GET['action'])) {
		$action  = $_GET['action'];
	}

/*...........Login api...............*/

	if ($action == 'login') {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$result = $conn->query("SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'");
		$users = array();

		while ($row = $result->fetch_assoc()) {
			array_push($users, $row);
		}

		if (!empty($users)) {

			$token = base64_encode(random_bytes(64));
			$token_send = $conn->query("UPDATE `user` SET `token` = '$token' WHERE `email` = '$email' AND `password` = '$password'");
			$token_result = $conn->query("SELECT `token` FROM `user` WHERE `email` = '$email' AND `password` = '$password'");
			while ($row_token = $token_result->fetch_assoc()) {
					$res['user_token'] = $row_token['token'];
				}


			$res['message'] = "User Login Successfully!!";
		}else{
			$res['error'] = true;
			$res['message'] = "Incorrect email or password!!";
		}
	}




	$conn->close();


/*header for CORS domain*/
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials", "true");
	header("Access-Control-Allow-Methods", "POST,GET,OPTIONS,PUT,DELETE");

	header("Content-type: application/json");
	echo json_encode($res);
	die();

