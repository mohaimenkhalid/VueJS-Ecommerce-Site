
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



/*...........Create Product...............*/

	if ($action == 'create') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];
   			$price = $_POST['price'];
   			$image = $_POST['image'];
   			$category = $_POST['category'];
   			$supplier = $_POST['supplier'];

		$result = $conn->query("INSERT INTO `product` (`pname`, `description`, `price`, `image`, `category`, `supplier` ) VALUES('$name', '$description', '$price', '$image', '$category', '$supplier') " );
		
		if ($result) {
			$res['message'] = "Product added successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Product could not insert";
		}
	}

/*...........read product...............*/

	if ($action == 'read') {
			$result = $conn->query("SELECT p.id, p.pname, p.price, p.image, p.description, p.supplier, p.category, c.cname, s.sname FROM product p, category c, supplier s WHERE p.category = c.id AND p.supplier = s.id ");
			$product = array();

			while ($row = $result->fetch_assoc()) {
				array_push($product, $row);
			}

			$res['product'] = $product;
		}

/*...........Update Category...............*/

	if ($action == 'update') {

   			$id = $_POST['id'];
   			$name = $_POST['pname'];
   			$description = $_POST['description'];
   			$price = $_POST['price'];
   			$category = $_POST['category'];
   			$supplier = $_POST['supplier'];

		$result = $conn->query("UPDATE `product` SET `pname` = '$name', `description` = '$description', `price` = '$price', `category` = '$category', `supplier` = '$supplier' WHERE `id`= '$id' ");
		
		if ($result) {
			$res['message'] = "product Updated successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Product could not Updated";
		}
	}

/*...........Delete Product...............*/

	if ($action == 'delete') {
 			
   			$id = $_POST['id'];

		$result = $conn->query("DELETE FROM `product`  WHERE `id` ='$id' ");
		
		if ($result) {
			$res['message'] = "Product Deleted successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Product could not Deleted";
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

