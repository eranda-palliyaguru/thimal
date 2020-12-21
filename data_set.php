<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$result = $db->prepare("SELECT * FROM collection  ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$collection_id=$row['id'];
$amount=$row['amount'];
$customer=$row['customer'];
$in=$row['invoice_no'];

$resultz = $db->prepare("SELECT * FROM payment WHERE sales_id='$in' AND type='credit'  ");
$resultz->bindParam(':userid', $tr_id);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$sales_id=$rowz['sales_id'];
$c_amount=$rowz['amount'];
$cus_id=$rowz['customer_id'];
$type=$rowz['type'];
$tr_id=$rowz['transaction_id'];
}

$act=2;
$now=date("Y-m-d");
$sql = "INSERT INTO credit_payment (tr_id,sales_id,collection_id,pay_amount,credit_amount,cus_id,date,action,cus,type) VALUES (:tr_id,:s_id,:p_id,:p_amo,:c_amo,:cus,:date,:act,:cus_n,:type)";
$q = $db->prepare($sql);
$q->execute(array(':tr_id'=>$tr_id,':s_id'=>$sales_id,':p_id'=>$collection_id,':p_amo'=>$amount,':c_amo'=>$c_amount,':cus'=>$cus_id,':date'=>$now,':act'=>$act,':cus_n'=>$customer,':type'=>$type));

}


?>
