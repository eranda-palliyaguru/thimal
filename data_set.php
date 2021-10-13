<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$resultz = $db->prepare("SELECT * FROM payment WHERE type='chq' AND chq_action='3' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $row = $resultz->fetch(); $i++){
$id=$row['transaction_id'];


$result = $db->prepare("SELECT * FROM credit_payment WHERE pay_id='$id' ");
$result->bindParam(':userid', $inva);
$result->execute();
for($i=0; $row1 = $result->fetch(); $i++){

  $pay_amount=$row1['pay_amount'];
  $sales_id=$row1['sales_id'];

  
  $resultz2 = $db->prepare("SELECT * FROM payment WHERE sales_id='$sales_id' AND type='credit'  ");
  $resultz2->bindParam(':userid', $inva);
  $resultz2->execute();
  for($i=0; $row2 = $resultz2->fetch(); $i++){
    $amount=$row2['amount'];
    if($pay_amount < $amount){ echo $sales_id;  }
  }

 }



}

?>
