<?php
session_start();
include('../../../connect.php');
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");
$time = date("h:i:sa");
$k = "load";

$cus_id=$_POST['cus'];
$loading=$_POST['loading'];
$invoice=$_POST['invo'];
$reason=$_POST['reason'];
$issue=$_POST['date'];


$result = $db->prepare("SELECT * FROM customer WHERE customer_id= :userid ");
$result->bindParam(':userid', $cus_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cus_name=$row['customer_name'];
}


$result = $db->prepare("SELECT * FROM loading WHERE transaction_id= :userid  ");
$result->bindParam(':userid', $loading);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$lorry=$row['lorry_no'];
$date=$row['date'];
}

// query
$sql = "INSERT INTO return_bill (customer_name,customer_id,issue_date,loading_id,lorry_no,date,reason,invoice_no) VALUES (?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($cus_name,$cus_id,$issue,$loading,$lorry,$date,$reason,$invoice));

$result = $db->prepare("SELECT * FROM return_bill ORDER by id DESC limit 0,1  ");
$result->bindParam(':userid', $loading);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];

}

header("location: ../bill_return.php?id=$id");

 ?>
