<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$id=$_GET['id'];
$pay_id=$_GET['pay_id'];


$cr1="5";
$sql = "UPDATE credit_payment
        SET action=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($cr1,$id));

header("location: bulk_payment.php?id=$pay_id");


?>
