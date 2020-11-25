<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$f = $_POST['chq_no'];
$type = $_POST['p_type'];
$from = $_POST['from'];
$balance = $_POST['balance'];
$bank="non";
if($type=="chq"){
	$amount_pay=0;
	$amount=$_POST['chq_amount'];
	$date= $_POST['chq_date'];
	$bank = $_POST['bank'];
	$action=2;
}
if($type=="cash"){
	$amount_pay=$_POST['cash_amount'];
    $amount=$_POST['cash_amount'];
	$date = date("Y-m-d");
	$action=1;
}

if($type=="coupon"){
	$amount_pay=$_POST['cup_amount'];
    $amount=$_POST['cup_amount'];
	$date = date("Y-m-d");
	$f=$_POST['cup_no'];
	$action=1;
}

if($type=="bank"){
	$amount_pay=$_POST['tr_amount'];
    $amount=$_POST['tr_amount'];
	//$date = date("Y-m-d");
	$date=$_POST['tr_date'];
	$bank = $_POST['tr_bank'];
	$action=1;
}



$a = $_POST['invoice_id'];
$now = date("Y-m-d");
$b = $_POST['order_id'];



$sql = "UPDATE payment
        SET pay_amount=pay_amount+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$a));


$result = $db->prepare("SELECT * FROM payment  WHERE transaction_id='$a'   ");
				$result->bindParam(':userid', $a);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
	            $balance1=$row['pay_amount'];
				$am=$row['amount'];
				$loding_id=$row['loading_id'];
				$sales_id=$row['sales_id'];
				$cus_id=$row['customer_id'];
			    $invo=$row['invoice_no'];
				}


if($am <= $balance1){
$ex="1";
$sql = "UPDATE payment
        SET action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($ex,$a));
}




$pay_c=1;





$sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id,pay_credit) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:cus,:crp,:sid,:act,:lod,:pyc)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invo,':b'=>$amount_pay,':c'=>$amount,':d'=>$type,':e'=>$date,':h'=>$now,':f'=>$f,':g'=>$bank,':cus'=>$cus_id,':crp'=>"",':sid'=>$sales_id,':act'=>$action,':lod'=>$loding_id,':pyc'=>$pay_c));

$r = $_POST['r'];
$cus = $_POST['cus'];
header("location: sales_credit.php?cus=$cus");	



// query



?>
