<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_POST['id'];
$user=$_SESSION['SESS_MEMBER_ID'];


$result1 = $db->prepare("SELECT * FROM stock_adjust WHERE id='$id' ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$tr_id=$row1['id'];
    $qty=$row1['qty'];
    $product_id=$row1['product_id'];
    $p_name=$row1['product_name'];
    $type=$row1['type'];


if ($type==1) {
  $sql = "UPDATE products
          SET qty=qty+?
      WHERE product_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($qty,$product_id));
  $log_type=7;
}
if ($type==2) {
  $sql = "UPDATE products
          SET qty=qty-?
      WHERE product_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($qty,$product_id));
  $log_type=8;
}

    $sql = "UPDATE stock_adjust
            SET action=?
    		WHERE id=?";
    $q = $db->prepare($sql);
    $q->execute(array('1',$id));


    $result = $db->prepare("SELECT * FROM products WHERE product_id= :userid  ");
    $result->bindParam(':userid', $product_id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    $qty_y=$row['qty'];
}


    $time=date("h:i.a");
    $date=date("Y-m-d");
    $action=1;

    $sql = "INSERT INTO stock_log (product_id,qty,product_name,date,time,action,source_id,yard_qty,type,user_id,comment) VALUES (:b,:f,:i,:j,:ti,:k,:m,:lb,:ty,:us,:com)";
    $q = $db->prepare($sql);
    $q->execute(array(':b'=>$product_id,':f'=>$qty,':i'=>$p_name,':j'=>$date,':k'=>$action,':m'=>$id,':lb'=>$qty_y,':ti'=>$time,':ty'=>$log_type,':us'=>$user,':com'=>"Stock Adjustment"));
}







header("location: stock_adjust_app.php");


?>
