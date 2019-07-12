
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



/*...........Create Category...............*/

	if ($action == 'create') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];

		$result = $conn->query("INSERT INTO `category` (`cname`, `description`) VALUES('$name', '$description') ");
		
		if ($result) {
			$res['message'] = "Category added successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Category could not insert";
		}
	}

/*...........read Category...............*/

	if ($action == 'read') {
			$result = $conn->query("SELECT * FROM `category` ");
			$category = array();

			while ($row = $result->fetch_assoc()) {
				array_push($category, $row);
			}

			$res['category'] = $category;
		}

/*...........Update Category...............*/

	if ($action == 'update') {

   			$name = $_POST['cname'];
   			$description = $_POST['description'];
   			$id = $_POST['id'];

		$result = $conn->query("UPDATE `category` SET `cname` = '$name', `description` = '$description' WHERE `id`= '$id' ");
		
		if ($result) {
			$res['message'] = "Category Updated successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Category could not Updated";
		}
	}

/*...........Delete Category...............*/

	if ($action == 'delete') {
 			
   			$id = $_POST['id'];

		$result = $conn->query("DELETE FROM `category`  WHERE `id` ='$id' ");
		
		if ($result) {
			$res['message'] = "Category Deleted successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Category could not Deleted";
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

