<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$resultz = $db->prepare("SELECT * FROM payment  WHERE type='credit' AND date BETWEEN '2022-03-08' AND '2022-03-21' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $row1 = $resultz->fetch(); $i++){
$cus_id=$row1['customer_id'];

 
$result = $db->prepare("SELECT * FROM customer  WHERE customer_id='$cus_id' ");
$result->bindParam(':userid', $inva);
$result->execute();
for($i=0; $row = $resultz->fetch(); $i++){


 
echo $row['credit_period']."_____".$row1['credit_period']."<br>";
 

 


}
}

?>
