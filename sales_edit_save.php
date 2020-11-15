<?php
session_start();
include("connect.php");
date_default_timezone_set("Asia/Colombo");


$u_name=$_SESSION['SESS_FIRST_NAME'];
$uid=$_SESSION['SESS_MEMBER_ID'];
$invo=$_POST['id'];


$result = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$cus=$row['name'];
$cus_id=$row['customer_id'];
$sales_id=$row['transaction_id'];
$loading_id=$row['loading_id'];

		}

$result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$pro_id=$row['product_id'];
$name=$row['gen_name'];
$price=$row['price'];
$o_price=$row['o_price'];



$qty=$_POST[$pro_id];
$amount=$price*$qty;
$profit=$price-$o_price;
$profit=$profit*$qty;
$date=date("Y-m-d");

$list_id="0";
$result1 = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$invo' and product_id='$pro_id'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$list_id=$row1['id'];
		}


if($list_id>1){

$sql = "UPDATE sales_list
        SET qty=?,amount=?,profit=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$amount,$profit,$list_id));

if($qty==""){

	$result = $db->prepare("DELETE FROM sales_list WHERE  id= :memid");
	$result->bindParam(':memid', $list_id);
	$result->execute();
}


}else{

if($qty>0){
$sql = "INSERT INTO sales_list (product_id,name,qty,price,amount,profit,date,action,invoice_no,loading_id,cus_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:act,:invo,:load,:cus)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$pro_id,':b'=>$name,':c'=>$qty,':d'=>$price,':e'=>$amount,':f'=>$profit,':g'=>$date,':act'=>'3',':invo'=>$invo,':load'=>$loading_id,':cus'=>$cus_id));
} }
		}





$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invo'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$total=$row1['sum(amount)'];
		}

$result1 = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no='$invo'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$tot_profit=$row1['sum(profit)'];
		}

$sql = "UPDATE sales
        SET amount=?,balance=?,profit=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($total,$total,$tot_profit,$sales_id));

header("location: sales_pay.php?id=$invo");
?>
