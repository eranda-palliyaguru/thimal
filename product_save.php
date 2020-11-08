<?php

session_start();

include('connect.php');

$a = $_POST['product_name'];
$b = $_POST['price'];
$c = $_POST['o_price'];

// query

$sql = "INSERT INTO products (gen_name,price,price,o_price) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$b,':d'=>$c));

header("location: product.php");

?>