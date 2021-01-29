<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$resultz = $db->prepare("SELECT * FROM payment WHERE type='credit' AND action='1' AND set_off_date=''  ");
$resultz->bindParam(':userid', $tr_id);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$sales_id=$rowz['sales_id'];
$tr_id=$rowz['transaction_id'];
$set_off='';

$result = $db->prepare("SELECT * FROM payment WHERE  sales_id='$sales_id' and pay_credit='1'  ");
    $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row1 = $result->fetch(); $i++){
$set_off=$row1['date'];
  }


//  $result = $db->prepare("SELECT * FROM credit_payment WHERE  sales_id='$sales_id' and action='0'  ");
//      $result->bindParam(':userid', $d1);
//            for($i=0; $row1 = $result->fetch(); $i++){
//  $set_off=$row1['date'];
//    }



//$set_off=date('Y-m-d');
$sql = "UPDATE payment
        SET set_off_date=?
    WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($set_off,$tr_id));
}


?>
