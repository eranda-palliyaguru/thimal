<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$chq_no = 0;
$type = $_POST['p_type'];
$invo = $_POST['invo'];
$bank="non";
if($type=="chq"){
	$amount_pay=0;
  $chq_no = $_POST['chq_no'];
	$amount=$_POST['chq_amount'];
	$date= $_POST['chq_date'];
	$bank = $_POST['bank'];
	$action=2;
}
if($type=="cash"){
	$amount_pay=$_POST['cash_amount'];
    $amount=$_POST['cash_amount'];
	$date = "";
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



$result = $db->prepare("SELECT * FROM sales  WHERE transaction_id='$invo'   ");
				$result->bindParam(':userid', $a);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
	            $customer=$row['name'];
                $cus_id=$row['customer_id'];
				}

$user_id=$_SESSION['SESS_MEMBER_ID'];
$now=date('Y-m-d');

$sql = "INSERT INTO collection (invoice_no,amount,pay_type,chq_no,chq_date,date,user_id,customer_id,customer) VALUES (?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invo,$amount,$type,$chq_no,$date,$now,$user_id,$cus_id,$customer));


header("location: lorry_credit_view.php");



// query



?>
