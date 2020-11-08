<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$uid=$_SESSION['SESS_MEMBER_ID'];
$u_name=$_SESSION['SESS_FIRST_NAME'];
$invo = $uid.date("ymdhHis");
$b = 0;
$date = $_POST['date'];
$d = 0;
$e = 0;
$z = 0;
$loading_id = $_POST['lorry'];


$result = $db->prepare("SELECT * FROM loading WHERE transaction_id='$loading_id' AND action='load' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$lorry = $row['lorry_no'];;
$root = $row['root'];;
$u_name = $row['driver'];
$term = $row['term'];
		}


$cus_id = $_POST['cus_name'];

  $result = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id' ORDER by customer_id DESC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$cus = $row['customer_name'];	
		}



$f = 0;


//------------------------------------------------------------------//

$sql = "INSERT INTO sales (invoice_number,cashier,date,name,lorry_no,loading_id,customer_id) VALUES (:a,:b,:c,:f,:g,:lo,:cus)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$invo,':b'=>$u_name,':c'=>$date,':f'=>$cus,':g'=>$lorry,':lo'=>$loading_id,':cus'=>$cus_id)); 



header("location: biling.php?id=$loading_id&invo=$invo");
exit();

// query



?>