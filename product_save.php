<?php

session_start();

include('connect.php');

$a = $_POST['product_name'];
$b = $_POST['price'];
$c = $_POST['o_price'];

// query

$sql = "INSERT INTO products (gen_name,price,o_price) VALUES (:a,:b,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':d'=>$c));

header("location: product.php");

?>
