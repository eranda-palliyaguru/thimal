<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$olld=0;
$now=date("Y-m-d");


$id = $_POST['id'];


$resultz = $db->prepare("SELECT * FROM collection WHERE  id='$id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$invoice_no=$rowz['invoice_no'];
$customer_id=$rowz['customer_id'];
$amount=$rowz['amount'];
$chq_no=$rowz['chq_no'];
$chq_date=$rowz['chq_date'];
$bank=$rowz['bank'];
$type=$rowz['pay_type'];
}





  $resultz = $db->prepare("SELECT * FROM credit_payment WHERE  pay_id='$pay_id' AND action='2' ");
  $resultz->bindParam(':userid', $inva);
  $resultz->execute();
  for($i=0; $rowz = $resultz->fetch(); $i++){
  $pay_amount=$rowz['pay_amount'];
  $tr_id=$rowz['tr_id'];
  $credit_id=$rowz['id'];
  $type=$rowz['type'];
}



  $ex="2";
  $sql = "UPDATE payment
          SET action=?
      WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($ex,$pay_id));



  $sql = "INSERT INTO purchases (invoice_no,pay_amount,amount,type,data,chq_no,chq_date,bank,sales_id,customer_id,pay_credit,action) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
  $q = $db->prepare($sql);
  $q->execute(array($invoice_no,$pay_amount,$amount,$type,$date,$chq_no,$chq_date,$bank,$invoice_no,$customer_id,"1",$action));



header("location: bulk_payment_print.php?id=$pay_id");
?>
