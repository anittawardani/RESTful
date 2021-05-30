<?php
	$url = 'http://localhost/RESTful/products';
	if (isset($_GET['product_id'])){
		$url .= '/'.$_GET['product_id'];
	}
	$ch  = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response_json = curl_exec($ch);
	curl_close($ch);
	$response = json_decode($response_json, true);
	echo $response_json;
?>