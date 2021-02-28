<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');


$price=$_POST['price'];
$up_price=$_POST['up_price'];
$product=$_POST['product'];

$sql = "UPDATE special_price
        SET price=?
		WHERE price=?
    AND product_id=?";
$q = $db->prepare($sql);
$q->execute(array($up_price,$price,$product));

header("location: special_price.php");

 ?>
