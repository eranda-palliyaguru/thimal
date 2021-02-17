<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$product_id=$_POST['product'];
$reason=$_POST['reason'];
$qty=$_POST['qty'];
$type=$_POST['type'];

$user=$_SESSION['SESS_MEMBER_ID'];




    $result = $db->prepare("SELECT * FROM products WHERE product_id= :userid  ");
    $result->bindParam(':userid', $product_id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    $product_name=$row['gen_name'];
}


    $time=date("h:i.a");
    $date=date("Y-m-d");
    $action=1;
    $sql = "INSERT INTO stock_adjust (product_id,qty,product_name,date,type,user_id,reason) VALUES (?,?,?,?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($product_id,$qty,$product_name,$date,$type,$user,$reason));



header("location: stock_adjust.php");


?>
