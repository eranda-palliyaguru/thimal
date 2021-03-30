<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$id=1;
    $sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id)
          SELECT invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id FROM payment
 		WHERE transaction_id=1 ";
  $q = $db->prepare($sql);
  $q->execute();

  //echo("Error description: " . $sql -> error);
  //echo mysql_error(connection);







?>
