<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");




$type = $_POST['type'];
$comment = $_POST['comment'];
$amount = $_POST['amount'];
$load = $_POST['loading_id'];
$lorry = $_POST['lorry'];
$date = date("Y-m-d");

$mt=3;

//echo $customer_name;

$sql = "INSERT INTO expenses_records (date,type,comment,amount,loading_id,lorry_no,m_type) VALUES (:date,:a,:b,:amount,:ba,:lor,:m)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':b'=>$comment,':date'=>$date,':amount'=>$amount,':ba'=>$load,':lor'=>$lorry,':m'=>$mt));


header("location: set_lorry_expenses.php");

?>