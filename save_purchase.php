<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['company'];
$c = $_POST['yard'];
$date = $_POST['date'];
$in=date("ymdHis");
// query
$sql = "INSERT INTO purchases (invoice_number,date,suplier,in_invoice) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$date,':c'=>$b,':d'=>$in));

header("location: purchase2.php?invoice=$in&date=$date");





?>