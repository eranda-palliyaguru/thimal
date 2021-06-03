<?php
session_start();
include('../../../connect.php');
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");
$time = date("h:i:sa");

$id=$_POST['id'];
$pro=$_POST['product'];
$qty=$_POST['qty'];
$price=$_POST['price'];

$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid ");
$result->bindParam(':userid', $pro);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$pro_name=$row['gen_name'];
$now_price=$row['price'];
}


// query
$sql = "INSERT INTO return_bill_list (product_name,product_id,qty,price,total,date,current_price,return_id) VALUES (?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($pro_name,$pro,$qty,$price,$qty*$price,$date,$now_price,$id));


header("location: ../bill_return.php?id=$id");

 ?>
