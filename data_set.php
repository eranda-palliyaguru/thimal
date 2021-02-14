<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM sales_list WHERE product_id='3'  AND  action='0' AND date BETWEEN '2021-01-01' and '2021-01-10' ");
$result->bindParam(':userid', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$id=$row['id'];
$date=$row['date'];

$pid='1';
                        $sql = "UPDATE sales_list
                        SET price_id=?
                     		WHERE id=? ";
                      $q = $db->prepare($sql);
                      $q->execute(array($pid,$id));



}


?>
