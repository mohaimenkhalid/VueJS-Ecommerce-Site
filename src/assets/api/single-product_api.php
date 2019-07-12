
<?php 
	
	$conn = new mysqli("localhost", "root", "", "ecommerce_vue");
	if ($conn->connect_error) {
		die("Database Could not Connected.");
	}


	$res = array('error' => false);

	$action= '';

 
	if (isset($_GET['id'])) {
		$id  = $_GET['id'];
	}




/*...........read product...............*/

	if ($id) {
			$result = $conn->query("SELECT p.id, p.pname, p.price, p.image, p.description, p.supplier, p.category, c.cname, s.sname FROM product p, category c, supplier s WHERE p.category = c.id AND p.supplier = s.id AND p.id = '$id' limit 1");
			$product = array();

			while ($row = $result->fetch_assoc()) {
				$res['product'] = $row;
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

