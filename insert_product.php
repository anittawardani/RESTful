<?php
$data = array(
			'product_name' => 'Television',
			'price' => 1000,
			'quantity' => 10
		);

$url = 'http://localhost/praktikumXML/RESTful/products';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json, true);
?>