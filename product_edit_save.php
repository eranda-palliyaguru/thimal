<?php
session_start();
include('connect.php');
$id =$_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$o_price = $_POST['o_price'];




$sql = "UPDATE products
        SET gen_name=?, price=?, price2=?, o_price=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$price,$price,$o_price,$id));




header("location: product.php");


?>
