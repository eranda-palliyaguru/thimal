<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$user=$_SESSION['SESS_MEMBER_ID'];

$type = $_POST['type'];
$date = date("Y-m-d");
if($type=="1"){$bank_id = $_POST['chq_no1'];
$charges = $_POST['charges1'];
$reason = $_POST['reason1'];
}else{
$bank_id = $_POST['chq_no'];
$charges = $_POST['charges'];
$reason = $_POST['reason'];
}



$result = $db->prepare("SELECT * FROM bank WHERE id='$bank_id' ");
$result->bindParam(':userid', $inva);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$chq_no=$row['chq_no'];
$pay_id=$row['payment_id'];
$amount=$row['amount'];
$chq_date=$row['chq_date'];
$cus_id=$row['cus_id'];
$bank=$row['bank'];
}


$resultz = $db->prepare("SELECT * FROM bank_balance  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$ba=$rowz['amount'];
}

$bank_action='3';
$sql = "UPDATE bank
        SET chq_action=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($bank_action,$bank_id));



$sales_id=0;
if($type=="1"){
$resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$pay_id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $row = $resultz->fetch(); $i++){
$sales_id=$row['sales_id'];
$invoice_no=$row['invoice_no'];
$loading_id=$row['loading_id'];
}



$sql = "UPDATE bank_balance
        SET amount=amount-?";
$q = $db->prepare($sql);
$q->execute(array($amount));



$sql = "UPDATE payment
        SET bank_action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($bank_action,$pay_id));

$sql = "UPDATE payment
        SET chq_action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($bank_action,$pay_id));



$amount_tot=$amount+$charges;

$sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:cus,:crp,:sid,:act,:lod)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invoice_no,':b'=>'0',':c'=>$amount_tot,':d'=>'credit',':e'=>$chq_date,':h'=>$date,':f'=>$chq_no,':g'=>$bank,':cus'=>$cus_id,':crp'=>'',':sid'=>$sales_id,':act'=>'2',':lod'=>$loading_id));
}



$sql = "INSERT INTO return_chq (date,type,chq_no,chq_date,amount,balance,pay_id,sales_id,bank_id,reason,user_id,charges) VALUES (:date,:a,:b,:chq_date,:amount,:ba,:p_id,:s_id,:b_id,:re,:u_id,:cha)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':b'=>$chq_no,':date'=>$date,':amount'=>$amount,':ba'=>$ba,':p_id'=>$pay_id,':s_id'=>$sales_id,':b_id'=>$bank_id,':chq_date'=>$chq_date,':re'=>$reason,':u_id'=>$user,':cha'=>$charges));


$type=6;
$res="CHQ RETURN CHARGES";
$sql = "INSERT INTO bank (date,type,amount,bank,balance,chq_no,chq_date,cus_id,cashier,payment_id,receive) VALUES (:da,:ty,:am,:bn,:ba,:c_no,:c_da,:cid,:cshi,:pay_id,:res)";
$q = $db->prepare($sql);
$q->execute(array(':da'=>$date,':am'=>$charges,':ba'=>$ba,':ty'=>$type,':bn'=>$bank,':c_no'=>$chq_no,':c_da'=>$chq_date,':cid'=>$cus_id,':cshi'=>$user,':pay_id'=>$pay_id,':res'=>$res));


header("location: chq_return.php");

?>
