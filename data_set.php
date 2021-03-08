<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM special_price WHERE product_id='1'  AND  price='1451' ");
$result->bindParam(':userid', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){


$id=$row['customer_id'];

$pid='2';
                        $sql = "UPDATE customer
                        SET area=?
                     		WHERE customer_id=? ";
                      $q = $db->prepare($sql);
                      $q->execute(array($pid,$id));



}


?>
