<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$invoice=$_POST['id'];
$user=$_SESSION['SESS_MEMBER_ID'];
$A1=1;

$result1 = $db->prepare("SELECT * FROM sales_list WHERE sales_id='$invoice' ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$tr_id=$row1['id'];
    $qty=$row1['qty'];
    $product_id=$row1['product_id'];
    $p_name=$row1['name'];



    $sql = "UPDATE products
            SET qty=qty+?
    		WHERE product_id=?";
    $q = $db->prepare($sql);
    $q->execute(array($qty,$product_id));

    $sql = "UPDATE sales_list
            SET action=?
    		WHERE id=?";
    $q = $db->prepare($sql);
    $q->execute(array('5',$tr_id));


    $result = $db->prepare("SELECT * FROM products WHERE product_id= :userid  ");
    $result->bindParam(':userid', $product_id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    $qty_y=$row['qty'];
}


    $time=date("h:i.a");
    $date=date("Y-m-d");
    $action=1;
    $type=5;
    $sql = "INSERT INTO stock_log (product_id,qty,product_name,date,time,action,source_id,yard_qty,type,user_id,comment) VALUES (:b,:f,:i,:j,:ti,:k,:m,:lb,:ty,:us,:com)";
    $q = $db->prepare($sql);
    $q->execute(array(':b'=>$product_id,':f'=>$qty,':i'=>$p_name,':j'=>$date,':k'=>$action,':m'=>$invoice,':lb'=>$qty_y,':ti'=>$time,':ty'=>$type,':us'=>$user,':com'=>"Bill Remove"));
}


$sql = "UPDATE sales
        SET remove=?,action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array('2','5',$invoice));

$sql = "UPDATE payment
        SET action=?
		WHERE sales_id=?";
$q = $db->prepare($sql);
$q->execute(array('0',$invoice));




header("location: bill_remove_app.php");


?>
