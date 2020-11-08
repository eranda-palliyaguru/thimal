<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['transaction_id'];
$b = 'Laugfs Gas PLC';
$c= date('Y/m/d');
$d='Processing.';




//edit qty
$sql = "UPDATE gift_voucher 
        SET type=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($d,$a));


$sql = "UPDATE gift_voucher 
        SET location=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$a));

$sql = "UPDATE gift_voucher 
        SET date=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$a));


header("location: gift_view.php");


?>