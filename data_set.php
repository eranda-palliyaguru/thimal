<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM sales WHERE action='1' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
$amount=$row['amount'];
$transaction_id=$row['transaction_id'];

$result1 = $db->prepare("SELECT sum(amount) FROM payment WHERE action >'0' AND sales_id='$transaction_id' ");
    $result1->bindParam(':userid', $res);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){
      $amount2=$row1['sum(amount)'];
    }

    if ($amount > $amount2) {
echo $transaction_id . "<br>";
    }
    }






?>
