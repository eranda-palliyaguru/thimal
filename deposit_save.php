<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$date=date("Y-m-d");



$id = $_GET['id'];
$t = $_GET['t'];
//$comment = $_POST['comment'];
$resultz = $db->prepare("SELECT * FROM bank_balance ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$balance=$rowz['amount'];
}

if($t=="1"){

$resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$amount=$rowz['amount'];
$bank=$rowz['bank'];
$chq_no=$rowz['chq_no'];
$chq_date=$rowz['chq_date'];
$cus_id=$rowz['customer_id'];
}
$cashier=$_SESSION['SESS_MEMBER_ID'];
//echo $customer_name;

$type=1;
$sql = "UPDATE payment
        SET bank_action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($type,$id));
}
if($t=="2"){
$resultz = $db->prepare("SELECT * FROM loading WHERE transaction_id='$id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$amount=$rowz['cash_total'];
$bank=$rowz['lorry_no'];
$chq_no=$rowz['transaction_id'];
$chq_date=$rowz['date'];
$cus_id=$rowz['driver'];
}

$cashier=$_SESSION['SESS_MEMBER_ID'];
//echo $customer_name;

$type=1;
$sql = "UPDATE loading
        SET bank_action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($type,$id));

$sql = "UPDATE bank_balance
        SET amount=amount+?";
$q = $db->prepare($sql);
$q->execute(array($amount));
$type=2;
}

if($t=="3"){
  $resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$id' ");
  $resultz->bindParam(':userid', $inva);
  $resultz->execute();
  for($i=0; $rowz = $resultz->fetch(); $i++){
  $amount=$rowz['amount'];
  $bank=$rowz['bank'];
  $chq_no=$rowz['sales_id'];
  $chq_date=$rowz['chq_date'];
  $cus_id=$rowz['customer_id'];
  }

  $resultz = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id' ");
  $resultz->bindParam(':userid', $inva);
  $resultz->execute();
  for($i=0; $rowz = $resultz->fetch(); $i++){
  $bank=$rowz['customer_name'];
  }

$cashier=$_SESSION['SESS_MEMBER_ID'];
//echo $customer_name;

$type=1;
$sql = "UPDATE payment
        SET bank_action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($type,$id));

$sql = "UPDATE bank_balance
        SET amount=amount+?";
$q = $db->prepare($sql);
$q->execute(array($amount));
$type=2;
}


$sql = "INSERT INTO bank (date,type,amount,bank,balance,chq_no,chq_date,cus_id,cashier,payment_id) VALUES (:da,:ty,:am,:bn,:ba,:c_no,:c_da,:cid,:cshi,:pay_id)";
$q = $db->prepare($sql);
$q->execute(array(':da'=>$date,':am'=>$amount,':ba'=>$balance,':ty'=>$type,':bn'=>$bank,':c_no'=>$chq_no,':c_da'=>$chq_date,':cid'=>$cus_id,':cshi'=>$cashier,':pay_id'=>$id));


header("location: deposit.php");

?>
