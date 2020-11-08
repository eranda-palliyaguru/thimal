<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$yard = $_POST['yard'];

$qty = $_POST['qty'];
$product_id = $_POST['product_id'];



if($yard==1){
$sql = "UPDATE products 
        SET qty=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product_id));
}

if($yard==2){
$sql = "UPDATE products 
        SET qty2=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product_id));
}

header("location: yard.php");
?>