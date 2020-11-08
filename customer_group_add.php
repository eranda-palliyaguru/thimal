<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$cus = $_POST['cus'];
$id = $_POST['id'];



$sql = "UPDATE customer 
        SET category=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($id,$cus));

header("location: customer_group.php?id=$id");
?>