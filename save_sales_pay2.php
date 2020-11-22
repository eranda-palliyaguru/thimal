<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');

$date="";
$f=0;
$g="non";
$a1 = $_POST['id'];
//$ar = $_POST['amount'];
$type = $_POST['p_type'];
//$c = $_POST['cus_name'];

$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$a1'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$total=$row1['sum(amount)'];
		}
$sql = "UPDATE sales
        SET balance=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($total,$a1));

$sql = "UPDATE sales
        SET amount=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($total,$a1));


$result1 = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no='$a1'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$profit=$row1['sum(profit)'];
		}
$sql = "UPDATE sales
        SET profit=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($profit,$a1));



$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $cus_id = $row['customer_id'];
			$sales_id = $row['transaction_id'];
			$bill_amount = $row['amount'];
			$loding_id = $row['loading_id'];
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
	$amount_pay=0;
	$f = $_POST['chq_no'];
	$g = $_POST['bank'];
	$amount=$_POST['chq_amount'];
	$date= $_POST['chq_date'];

	 $split = explode("-", $date);
            $d= $split[0];
			$m= $split[1];
			$y= $split[2];

			$date=$y."-".$m."-".$d;



	$action=2;
}
if($type=="cash"){
	$amount_pay=$_POST['cash_amount'];
    $amount=$_POST['cash_amount'];
	$action=1;
}
if($type=="credit"){
    $amount=$bill_amount-$pay_balance;
	$amount_pay=0;
$action=2;
}



if($type=="coupon"){
    $amount=$_POST['cup_amount'];
	$f = $_POST['cup_no'];
	$amount_pay=0;
    $action=2;
}


$sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,chq_date,chq_no,bank,date,customer_id,credit_period,sales_id,action,loading_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:cus,:crp,:sid,:act,:lod)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a1,':b'=>$amount_pay,':c'=>$amount,':d'=>$type,':e'=>$date,':h'=>$now,':f'=>$f,':g'=>$g,':cus'=>$cus_id,':crp'=>$credit_p,':sid'=>$sales_id,':act'=>$action,':lod'=>$loding_id));

$action=1;
$sql = "UPDATE sales
        SET balance=balance-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$sales_id));

$sql = "UPDATE sales
        SET action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($action,$sales_id));



$result1 = $db->prepare("SELECT count(amount) FROM payment WHERE sales_id='$sales_id'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$count=$row1['count(amount)'];
		}


if($count<2){
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
		} }


$result = $db->prepare("SELECT * FROM sales WHERE invoice_number = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$balance = $row['balance'];
		}

if($balance>1){header("location: other_pay.php?id=$a1");}else{
header("location: bill.php?id=$a1");}
?>
