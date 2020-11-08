<?php

session_start();

include('connect.php');
$name = $_POST['name'];

//$g = $_POST['root'];



// query

$sql = "INSERT INTO customer_category ( name ) VALUES (:a)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$name));

header("location: customer_category.php");





?>