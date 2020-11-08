<?php 
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$amount=$_POST['chq_amount'];
$chq_no=$_POST['chq_no'];
$chq_date=$_POST['chq_date'];
$invo=$_POST['invo'];

$date=date("Y-m-d");
$bank="SAMPATH BANK";
$cashier=$_SESSION['SESS_MEMBER_ID'];


$reci="LAUGFS Gas PLC";

$resultz = $db->prepare("SELECT * FROM bank_balance  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$balance=$rowz['amount'];
}



$result = $db->prepare("SELECT * FROM purchases_item WHERE  invoice= '$invo' ");
$result->bindParam(':userid', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cord=$row['cord'];
$qty=$row['qty'];

$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$cord));
}

$sql = "INSERT INTO bank (date,type,amount,bank,balance,chq_no,chq_date,receive,cashier,payment_id) VALUES (:da,:ty,:am,:bn,:ba,:c_no,:c_da,:cid,:cshi,:pay_id)";
$q = $db->prepare($sql);
$q->execute(array(':da'=>$date,':am'=>$amount,':ba'=>$balance,':ty'=>'3',':bn'=>$bank,':c_no'=>$chq_no,':c_da'=>$chq_date,':cid'=>$reci,':cshi'=>$cashier,':pay_id'=>$invo));


header("location: purchase.php");
?>