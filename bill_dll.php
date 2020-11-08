<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
  
  
 
$id=$_GET['id'];
//$loid=$_GET['loid'];

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no= :userid ");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$cod=$row['product_id'];
$loading_id=$row['loading_id'];

	
$sql = "UPDATE loading_list 
        SET qty_sold=qty_sold+?
		WHERE product_code=?
		AND loading_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$cod,$loading_id));

}

$cr="5";

$sql = "UPDATE sales 
        SET action=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($cr,$id));

$cr="0";
$sql = "UPDATE payment 
        SET action=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($cr,$id));

$cr1="1";
$sql = "UPDATE sales_list 
        SET action=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($cr1,$id));

//header("location: unloding_stock.php?id=$loid");


?>