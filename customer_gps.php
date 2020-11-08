<?php 
session_start();
include("connect.php");
date_default_timezone_set("Asia/Colombo");

$l=$_POST['l'];
$q1=$_POST['q'];
$cus=$_POST['cus'];


$sql = "UPDATE customer 
        SET l=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($l,$cus));


$sql = "UPDATE customer 
        SET q=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($q1,$cus));

header("location: customer.php");
?>