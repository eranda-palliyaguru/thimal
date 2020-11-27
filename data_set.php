<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM payment WHERE action='2' AND type='credit' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
$amount=$row['amount'];
$pay_amount=$row['pay_amount'];
$transaction_id=$row['transaction_id'];

    if ($amount == $pay_amount) {
echo $transaction_id . "<br>";
    }
    }






?>
