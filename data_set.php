<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM special_price WHERE product_id='3'  AND  price='6295' ");
$result->bindParam(':userid', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){


$id=$row['customer_id'];

$pid='0';
                        $sql = "UPDATE customer
                        SET price_37=?
                     		WHERE customer_id=? ";
                      $q = $db->prepare($sql);
                      $q->execute(array($pid,$id));



}


?>
