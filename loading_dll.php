<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
 
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM loading_list WHERE  transaction_id= :userid ");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$cod=$row['product_code'];
$lid=$row['loading_id'];
$yard=$row['load_yard_before'];
}


$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$cod));

$action=5;

$sql = "UPDATE stock_log 
        SET action=?
		WHERE qty=?
		AND source_id=?
		AND yard_qty=?
		AND product_id=?";
$q = $db->prepare($sql);
$q->execute(array($action,$qty,$lid,$yard,$cod));



$result = $db->prepare("DELETE FROM loading_list WHERE  transaction_id= :memid");
$result->bindParam(':memid', $id);
$result->execute();



header("location: loading2.php?id=$lid"); 

?>