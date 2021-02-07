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

function response($y,$m,$d,$h,$i,$s){
	$response['Y'] = $Y;
	$response['M'] = $m;
	$response['D'] = $d;
	$response['h'] = $h;
	$response['m'] = $i;
	$response['s'] = $s;


	$json_response = json_encode($response);
	echo $json_response;
}
?>
