
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



/*...........Create Product...............*/

	if ($action == 'create') {

   			$name = $_POST['name'];
   			$description = $_POST['description'];
   			$price = $_POST['price'];
   			$image = $_POST['image'];
   			$category = $_POST['category'];
   			$brand = $_POST['brand'];
   			$featured = $_POST['featured'];

   			$slug= preg_replace('/[^A-Za-z0-9-]+/', '-', $name);
	


		$result = $conn->query("INSERT INTO `product` (`pname`, `description`, `price`, `image`, `category`, `brand`, `featured`,  `slug` ) VALUES('$name', '$description', '$price', '$image', '$category', '$brand', '$featured', '$slug') " );
		
		if ($result) {
			$res['message'] = "Product added successfully";
		}else{
			$res['error'] = true;
			$res['message'] = "Product could not insert";
		}
	}

/*...........read product...............*/

	if ($action == 'read') {
			$result = $conn->query("SELECT p.id, p.pname, p.price, p.image, p.description, p.category, p.brand, p.featured, p.available, p.slug, c.cname, b.bname FROM product p, category c, brand b WHERE p.category = c.id AND p.brand = b.id ");
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
   			$brand = $_POST['brand'];
   			$featured = $_POST['featured'];
   			$status = $_POST['available'];

		$result = $conn->query("UPDATE `product` SET `pname` = '$name', `description` = '$description', `price` = '$price', `category` = '$category', `brand` = '$brand', `featured` = '$featured', `available` = '$status' WHERE `id`= '$id' ");
		
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

