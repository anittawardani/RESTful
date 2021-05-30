<?php
$connection     = mysqli_connect('localhost','root','','rest_api'); //koneksi ke database
$request_method = $_SERVER["REQUEST_METHOD"]; //mengambil metode request digunakan client
switch($request_method) {
	case 'GET'://Metode GET, meretrieve produk dengan product_id tertentu?
		if(!empty($_GET["product_id"])) {
			$product_id = intval($_GET["product_id"]);
			get_products($product_id);
		} else { //jika tidak dengan product_id, berarti semua produk
			get_products();
		}
		break;
	case 'POST': // Metode POST, menambahkan produk baru (Insert)
		insert_product();
		break;
	case 'PUT': // Metode PUT, client ingin mengupdate produk tertentu
		$product_id = intval($_GET["product_id"]);
		update_product($product_id);
		break;
	case 'DELETE': // Metode DELETE, client iningin menghapus produk tertentu
		$product_id = intval($_GET[" product_id"]);
		delete_product($product_id);
		break;
	default: // Jika bukan salah satu dari 4 metode di atas
		header("HTTP/1.0 405 Metode Tidak Dikenali. ");
		break;
}

function get_products($product_id=0) {
	global $connection;
	//query mengambil semua produk
	$query = "SELECT * FROM products";
	//hanya mengambil satu produk sesuai product_id
	if($product_id != 0) {
		$query .= " WHERE product_id = '$product_id' LIMIT 1";
	}
	$response = array();
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($result)) {
		$response[] = $row;
	}
	//respon untuk client dalam format JSON
	header('Content-Type: application/json');
	echo json_encode($response);
}

function insert_product() {
	global $connection;
	$product_name= $_POST["product_name"];
	$price		 = $_POST['price'];
	$quantity 	 = $_POST['quantity'];
	$query = "INSERT INTO products(product_name, price, quantity) VALUES('$product_name', '$price', '$quantity')";
	if(mysqli_query($connection, $query)) {
		$response = array(
						'status' => 1,
						'status_message' =>'Produk berhasil ditambahkan.'
					);
	} else {
		$response = array(
						'status' => 0,
						'status_message' =>' Produk GAGAL ditambahkan.'
					);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function update_product($product_id) {
	global $connection;
	parse_str(file_get_contents("php://input"), $post_vars);
	$product_name = $post_vars['product_name'];
	$price 		  = $post_vars['price']; 
	$quantity 	  = $post_vars['quantity'];
	$query = "UPDATE products SET product_name = '$product_name', price = '$price', quantity = '$quantity' WHERE id = '$product_id'";
	if (mysqli_query($connection, $query)) {
		$response = array(
						'status' => 1,
						'status_message' =>'Produk berhasil diupdate.'
		);
	} else {
		$response = array(
						'status' => 0,
						'status_message' =>'Produk GAGAL diupdate.'
					);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function delete_product($product_id) {
	global $connection;
	$query = "DELETE FROM products WHERE id = '$product_id'";
	if (mysqli_query($connection, $query)) {
		$response = array(
						'status' => 1,
						'status_message' => 'Produk berhasil dihapus.'
					);
	} else {
		$response = array(
						'status' => 0,
						'status_message' => 'Produk GAGAL dihapus.'
					);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}
?>