<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM special_price ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
$customer_id=$row['customer_id'];
$product_id=$row['product_id'];
$price_o=$row['price'];
$customer=$row['customer'];

$result1 = $db->prepare("SELECT * FROM sales_list WHERE action='0' AND cus_id='$customer_id' AND product_id='$product_id' ");
    $result1->bindParam(':userid', $res);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){
      $name=$row1['name'];
      $qty=$row1['qty'];
      $price=$row1['price'];
      $amount=$row1['amount'];
      $loading_id=$row1['loading_id'];
      $invoice_no=$row1['invoice_no'];
      $date=$row1['date'];




$cal=$price_o*$qty;

    if ($amount > $cal) {
echo $name ."___".$customer."__<a href='bill2.php?id=".$invoice_no. "'>bill</a>".$amount."/".$cal."---".$date."<br>";
}
    }
    }






?>
