<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$resultz = $db->prepare("SELECT * FROM payment WHERE type='credit' AND pay_amount > '0'  ");
$resultz->bindParam(':userid', $tr_id);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$sales_id=$rowz['sales_id'];
$pay=$rowz['pay_amount'];
$set_off='';

//$result = $db->prepare("SELECT * FROM payment WHERE  sales_id='$sales_id' and pay_credit='1'  ");
//    $result->bindParam(':userid', $d1);
//          $result->execute();
//          for($i=0; $row1 = $result->fetch(); $i++){
//$set_off=$row1['date'];
//  }


  $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  sales_id='$sales_id' AND pay_credit='1'  ");
      $result->bindParam(':userid', $d1);
      $result->execute();
      for($i=0; $row1 = $result->fetch(); $i++){
  $sum=$row1['sum(amount)'];
    }
$deff=$sum-$pay;

if ($pay < $sum) {
echo $sales_id."__".$deff."<br>";
}



//echo $sales_id."__".$deff."<br>";


}


?>
