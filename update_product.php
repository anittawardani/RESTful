<?php
$data = array(
			'product_name' => 'Laptop',
			'price' => 1200,
			'quantity' => 15
		);

$url = 'http://localhost/praktikumXML/RESTful/products/3';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json, true);
?>