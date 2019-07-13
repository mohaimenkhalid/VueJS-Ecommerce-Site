<?php 
/*header for CORS domain*/
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials", "true");
	header("Access-Control-Allow-Methods", "POST,GET,OPTIONS,PUT,DELETE");
	header("Content-type: application/json");

	$res = [];
	$target_dir = "../img/uploads/products/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"] ["name"]);

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$res['message'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$res["uploaderUrl"] = $target_file;
	}else{
		$res['message'] = "sorry! there was an error uploading your file.";
	}


	echo json_encode($res);
	die();
 ?>