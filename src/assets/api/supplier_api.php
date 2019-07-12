
<?php 
	
	$conn = new mysqli("localhost", "root", "", "ecommerce_vue");
	if ($conn->connect_error) {
		die("Database Could not Connected.");
	}


	$res = array('error' => false);

	$action= 'create';

 
	if (isset($_GET['action'])) {
		$action  = $_GET['action'];
	}



/*...........Create Supplier...............*/

	if ($action == 'create') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];

		$result = $conn->query("INSERT INTO `supplier` (`sname`, `description`) VALUES('$name', '$description') ");
		
		if ($result) {
			$res['message'] = "Supplier added successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Supplier could not insert";
		}
	}

/*...........read Supplier...............*/

	if ($action == 'read') {
			$result = $conn->query("SELECT * FROM `supplier` ");
			$supplier = array();

			while ($row = $result->fetch_assoc()) {
				array_push($supplier, $row);
			}

			$res['supplier'] = $supplier;
		}

/*...........Update Supplier...............*/

	if ($action == 'update') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];
   			$id = $_POST['id'];

		$result = $conn->query("UPDATE `supplier` SET `sname` = '$name', `description` = '$description' WHERE `id`= '$id' ");
		
		if ($result) {
			$res['message'] = "Supplier Updated successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Supplier could not Updated";
		}
	}

/*...........Delete Supplier...............*/

	if ($action == 'delete') {
 			
   			$id = $_POST['id'];

		$result = $conn->query("DELETE FROM `supplier`  WHERE `id` ='$id' ");
		
		if ($result) {
			$res['message'] = "Supplier Deleted successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Supplier could not Deleted";
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

