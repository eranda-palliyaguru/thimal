<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');

$date="";
$f=0;
$g="non";
$a1 = $_POST['id'];
$memo="";
//$ar = $_POST['amount'];
$type = $_POST['p_type'];
//$c = $_POST['cus_name'];


$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus_id = $row['customer_id'];
			$sales_id = $row['transaction_id'];
			$bill_amount = $row['amount'];
			$loding_id = $row['loading_id'];
			$action = $row['action'];
		}

if ($action==1) {
header("location: bill.php?id=$a1");
}else {


		$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$a1' ");
				$result->bindParam(':userid', $res);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
					$balance2 = $row['balance'];
				}


$result = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$credit_p=$row['credit_period'];

		}



$result = $db->prepare("SELECT sum(amount) FROM payment WHERE sales_id ='$sales_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $pay_balance=$row['sum(amount)'];
		}


$now=date("Y-m-d");
		if($type=="chq"){
$now=date("Y-m-d");
	$amount_pay=0;
	$f = $_POST['chq_no'];
	$g = $_POST['bank'];
	$amount=$_POST['chq_amount'];
	$date= $_POST['chq_date'];
	$action=2;

//-------- check chq date -------//
	if (strpos($date, 'y') !== false) {
$_SESSION['posttimer'] = time();
$_SESSION['error'] = " CHQ පතේ දිනය නිවැරදිව ඇතුලත් කරන්න ";
	}
	if (strpos($date, 'm') !== false) {
$_SESSION['posttimer'] = time();
$_SESSION['error'] = " CHQ පතේ දිනය නිවැරදිව ඇතුලත් කරන්න ";
	}
	if (strpos($date, 'd') !== false) {
$_SESSION['posttimer'] = time();
$_SESSION['error'] = " CHQ පතේ දිනය නිවැරදිව ඇතුලත් කරන්න ";
	}
				  $sday= strtotime( $now);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);
	if ($rs1 > 180) {
								$_SESSION['posttimer'] = time();
								$_SESSION['error'] = "  මාස 6ට වඩා දින පරාසයක් ඇති CHQ පත් ඇතුලත් කර නොහැක <br>   CHQ පතේ දිනය නිවැරදිදැයි පරික්ශාකරන්න";
									}

//-------- check chq number -------//
if ($f=="") {
	$_SESSION['posttimer'] = time();
	$_SESSION['error'] = " CHQ පතේ අංකය නිවැරදිව ඇතුලත් කරන්න ";
}

//-------- check chq bank -------//
if ($g=="") {
	$_SESSION['posttimer'] = time();
	$_SESSION['error'] = " CHQ පත අයත් බැංකුව නිවැරදිව ඇතුලත් කරන්න ";
}

}
//---- ****Cash****-----//
if($type=="cash"){
	$amount_pay=$_POST['cash_amount'];
    $amount=$_POST['cash_amount'];
	$action=1;
}
//---- ****Credit****-----//
if($type=="credit"){
	$memo=$_POST['credit_memo'];
    $amount=$bill_amount-$pay_balance;
	$amount_pay=0;
$action=2;
}
//---- ****Coupon****-----//
if($type=="coupon"){
    $amount=$_POST['cup_amount'];
	$f = $_POST['cup_no'];
	$amount_pay=0;
    $action=2;
}

if($type=="2kg"){
	$amount=0;$qty_2kg=0;
	$amount_pay=0;
    $action=2;
	$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$a1' AND product_id='6'");
			$result->bindParam(':userid', $res);
			$result->execute();
			for($i=0; $row = $result->fetch(); $i++){
	$qty_2kg=$row['qty'];
	$price_2kg=$row['price'];
			}
		$in_qty = $_POST['2kg'];
if ($qty_2kg >= $in_qty) {
	$amount=$price_2kg*$in_qty;
}else {
	$_SESSION['posttimer'] = time();
	$_SESSION['error'] = " නිවැරදි 2kg cylinder ප්‍රමානය ඇතුලත් කරන්න  ";
}
	$f=$_POST['2kg'];

}


$action='0';


//--------------------- Check bublicate ----------------------//
if (isset($_POST) ) {
   if (isset($_SESSION['posttimer'])) {

				      if ( (time() - $_SESSION['posttimer']) >= 2) {
				       // more than 2 seconds since last post


$sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id,memo) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:cus,:crp,:sid,:act,:lod,:memo)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a1,':b'=>$amount_pay,':c'=>$amount,':d'=>$type,':e'=>$date,':h'=>$now,':f'=>$f,':g'=>$g,':cus'=>$cus_id,':crp'=>$credit_p,':sid'=>$sales_id,':act'=>$action,':lod'=>$loding_id,':memo'=>$memo ));


$sql = "UPDATE sales
        SET balance=balance-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$sales_id));

$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$balance = $row['balance'];
		}

if($balance>1){header("location: other_pay.php?id=$a1");}else{

//------------- Update Action --------------//
$action=1;
	$sql = "UPDATE sales
	        SET action=?
			WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($action,$sales_id));

	$time=date("H:i");
	$sql = "UPDATE sales
	        SET time=?
			WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($time,$sales_id));

	$ac=0;
	$sql = "UPDATE sales_list
	        SET action=?
			WHERE invoice_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($ac,$a1));

	$sql = "UPDATE sales_list
					SET sales_id=?
			WHERE invoice_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($sales_id,$a1));
//-------------*/ Update Action --------------//

//------------- Update QTY --------------//
	$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$a1' ");
			$result->bindParam(':userid', $res);
			$result->execute();
			for($i=0; $row = $result->fetch(); $i++){
	$pro_id=$row['product_id'];
	$qty=$row['qty'];

	$sql = "UPDATE loading_list
	        SET qty_sold=qty_sold-?
			WHERE loading_id=? AND product_code=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$loding_id,$pro_id));
			}
//-------------*/ Update QTY --------------//

//------------- Update payment action --------------//
	$result = $db->prepare("SELECT * FROM payment WHERE sales_id ='$sales_id' ");
			$result->bindParam(':userid', $res);
			$result->execute();
			for($i=0; $row = $result->fetch(); $i++){
	$pay_id=$row['transaction_id'];
	$type=$row['type'];

if ($type=='cash') {
	$action=1;
	$sql = "UPDATE payment
	        SET action=?
			    WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($action,$pay_id));
}else {
	$action=2;
	$sql = "UPDATE payment
	        SET action=?
			    WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($action,$pay_id));
}
//------------- 2kg to 5kg promotion -------------//
if ($type=='2kg') {
$tt=1; $qty=$row['chq_no'];$pro_co="8";
	$result11 = $db->prepare("SELECT * FROM loading_list WHERE loading_id ='$loding_id' AND product_code='$pro_co' ");
			$result11->bindParam(':userid', $res);
			$result11->execute();
			for($i=0; $row11 = $result11->fetch(); $i++){
				$tt=$row11['transaction_id'];
			}
if ($tt > 1) {
	$sql = "UPDATE loading_list
	        SET qty_sold=qty_sold+?
			WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$tt));
}
if($tt==1){

$lorry_no="";
	$result11 = $db->prepare("SELECT * FROM loading_list WHERE loading_id ='$loding_id' ");
			$result11->bindParam(':userid', $res);
			$result11->execute();
			for($i=0; $row11 = $result11->fetch(); $i++){
				$lorry_no=$row11['lorry_no'];
				$date=$row11['date'];
			}
$b='8';
$c=$row['chq_no'];
$f="";
$h='';
$ii='2kg cylinder';
$k='load';
$j1=date('Y-m-d_h:i:sa');

	$sql = "INSERT INTO loading_list (product_code,qty,price,lorry_no,profit,product_name,date,action,qty_sold,loading_time,loading_id,load_yard_before) VALUES (:b,:f,:g,:c,:h,:i,:j,:k,:l,:j1,:m,:lb)";
	$q = $db->prepare($sql);
	$q->execute(array(':b'=>$b,':c'=>$lorry_no,':f'=>$c,':g'=>"",':h'=>$h,':i'=>$ii,':j'=>$date,':k'=>$k,':l'=>$c,':j1'=>$j1,':m'=>$loding_id,':lb'=>"0"));
}
}
//-------------*/ 2kg to 5kg promotion -------------//
			}
//-------------*/ Update payment action --------------//
$_SESSION['page']="END";

header("location: bill.php?id=$a1");}

} else {


	if($balance2>1){header("location: other_pay.php?id=$a1");}else{	header("location: bill.php?id=$a1");}
}
}
$_SESSION['posttimer'] = time();

}
}
?>
