<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$a = $_POST['comment'];
$cus_id = $_POST['customer'];
$c = $_POST['type'];
$pro_id = $_POST['product'];
$e = $_POST['date'];
//$f = $_POST['loading_id'];
$g = date("Y-m-d");
$h = $_POST['qty'];






    $result = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$b=$row['customer_name'];
		}

 $result = $db->prepare("SELECT * FROM products WHERE product_id='$pro_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$d=$row['gen_name'];
		}


$sql = "UPDATE products 
        SET trust=trust+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($h,$pro_id));



$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($h,$pro_id));


$ii='active';


$sql = "INSERT INTO trust (customer_name,product,date,end_date,comment,type,status,qty,customer_id,product_id) VALUES (:a,:b,:c,:d,:e,:f,:i,:h,:cus_id,:pro_id)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$b,':b'=>$d,':c'=>$g,':d'=>$e,':e'=>$a,':f'=>$c,':i'=>$ii,':h'=>$h,':cus_id'=>$cus_id,':pro_id'=>$pro_id));


header("location: trust_view.php");

exit();



// query







?>