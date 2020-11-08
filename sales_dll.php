<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
  
  
 
$id=$_GET['id'];
$invo=$_GET['invo'];


$result = $db->prepare("DELETE FROM sales_list WHERE  id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();


header("location: bill2.php?id=$id&invo=$invo");

?>