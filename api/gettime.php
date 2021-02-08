<?php
include 'DBConnection.php';
$no=1;
 date_default_timezone_set("Asia/Colombo");
header("Content-Type:application/json");
$key = $_GET['key'];
$did = $_GET['did'];
$con = $_GET['con'];

$y=date("y");
$m=date("m");
$d=date("d");
$h=date("H");
$i=date("i");
$s=date("s");

$response = array("y"=>$y, "M"=>$m, "d"=>$d, "h"=>$h, "m"=>$i, "s"=>$s);
//	$response['Y'] = "2021";
	$json_response = json_encode($response);
	echo $json_response;

?>
