<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$chq_no = 0;
$type = $_POST['p_type'];
$invo = $_POST['invo'];
$tr_id = $_POST['tr_id'];
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

				$uid=$_SESSION['SESS_MEMBER_ID'];
						$result = $db->prepare("SELECT * FROM user WHERE id='$uid'   ");
				$result->bindParam(':userid', $res);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$emid=$row['EmployeeId'];
				}
					$result = $db->prepare("SELECT * FROM loading WHERE driver='$emid' and action='load'   ");
				$result->bindParam(':userid', $res);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				 $tid=$row['transaction_id'];
				}




$user_id=$_SESSION['SESS_MEMBER_ID'];
$now=date('Y-m-d');

$sql = "INSERT INTO collection (invoice_no,amount,pay_type,chq_no,chq_date,date,user_id,customer_id,customer,bank,loading_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invo,$amount,$type,$chq_no,$date,$now,$user_id,$cus_id,$customer,$bank,$tid));

$result = $db->prepare("SELECT * FROM collection WHERE loading_id='$tid'  ORDER by id DESC limit 0,1  ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$collection_id=$row['id'];
}

$resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$tr_id'  ");
$resultz->bindParam(':userid', $tr_id);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$sales_id=$rowz['sales_id'];
$c_amount=$rowz['amount'];
$cus_id=$rowz['customer_id'];
$type=$rowz['type'];
}

$act=2;

$sql = "INSERT INTO credit_payment (tr_id,sales_id,collection_id,pay_amount,credit_amount,cus_id,date,action,cus,type) VALUES (:tr_id,:s_id,:p_id,:p_amo,:c_amo,:cus,:date,:act,:cus_n,:type)";
$q = $db->prepare($sql);
$q->execute(array(':tr_id'=>$tr_id,':s_id'=>$invo,':p_id'=>$collection_id,':p_amo'=>$c_amount,':c_amo'=>$c_amount,':cus'=>$cus_id,':date'=>$now,':act'=>$act,':cus_n'=>$customer,':type'=>$type));



header("location: lorry_credit_view.php");



// query



?>
