<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
  
  
 
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM purchases_item WHERE  transaction_id= :userid ");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$c=$row['qty'];
$co=$row['cord'];
}
 
$yard=1;




$result = $db->prepare("DELETE FROM purchases_item WHERE  transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

?>