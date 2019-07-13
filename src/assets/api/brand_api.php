
<?php 
	
	$conn = new mysqli("localhost", "root", "", "vue-ecom");
	if ($conn->connect_error) {
		die("Database Could not Connected.");
	}


	$res = array('error' => false);

	$action= 'create';

 
	if (isset($_GET['action'])) {
		$action  = $_GET['action'];
	}



/*...........Create Brand...............*/

	if ($action == 'create') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];

		$result = $conn->query("INSERT INTO `brand` (`bname`, `description`) VALUES('$name', '$description') ");
		
		if ($result) {
			$res['message'] = "Brand added successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Brand could not insert";
		}
	}

/*...........read Brand...............*/

	if ($action == 'read') {
			$result = $conn->query("SELECT * FROM `brand` ");
			$brand = array();

			while ($row = $result->fetch_assoc()) {
				array_push($brand, $row);
			}

			$res['brand'] = $brand;
		}

/*...........Update Brand...............*/

	if ($action == 'update') {

   			$name = $_POST['bname'];
   			$description = $_POST['description'];
   			$id = $_POST['id'];

		$result = $conn->query("UPDATE `brand` SET `bname` = '$name', `description` = '$description' WHERE `id`= '$id' ");
		
		if ($result) {
			$res['message'] = "Brand Updated successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Brand could not Updated";
		}
	}

/*...........Delete Brand...............*/

	if ($action == 'delete') {
 			
   			$id = $_POST['id'];

		$result = $conn->query("DELETE FROM `brand`  WHERE `id` ='$id' ");
		
		if ($result) {
			$res['message'] = "A Brand Deleted successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Brand could not Deleted";
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

