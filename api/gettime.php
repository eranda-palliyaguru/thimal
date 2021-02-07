<?php
include 'DBConnection.php';
$no=1;

$key = $_GET['key'];
$did = $_GET['did'];
$con = $_GET['con'];

$y=date("Y");
$m=date("m");
$d=date("d");
$h=date("H");
$i=date("i");
$s=date("s");

function response(){
	$response['id'] = $id;
	$response['invoice_number'] = $invoice_number;
	$response['customer_name'] = $customer_name;


	$json_response = json_encode($response);
	echo $json_response;
}
?>
