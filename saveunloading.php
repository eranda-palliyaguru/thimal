<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$c = $_POST['lorry'];


$j = date("Y/m/d_h:i:sa");
$k = "load";

$yard=$_POST['yard'];









if($yard==1){

$result = $db->prepare("SELECT * FROM loading WHERE lorry_no= :userid AND action='load' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$p_name=$row['product_name'];
$id=$row['transaction_id'];
$date=$row['date'];

$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($row['qty'],$row['product_code']));


$result1 = $db->prepare("SELECT * FROM products WHERE gen_name= :userid  ");
$result1->bindParam(':userid', $p_name);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){
$qty=$row['qty'];

$sql = "UPDATE loading 
        SET yard_before=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));




$sql = "UPDATE loading 
        SET unload_yard=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array('Kaluthara Yard',$id));


$sql = "UPDATE loading 
        SET unloading_time=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($j,$id));


}

}

}







if($yard==2){

$result = $db->prepare("SELECT * FROM loading WHERE lorry_no= :userid AND action='load' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$p_name=$row['product_name'];
$id=$row['transaction_id'];
$date=$row['date'];

$sql = "UPDATE products 
        SET qty2=qty2+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($row['qty'],$row['product_code']));




$result1 = $db->prepare("SELECT * FROM products WHERE gen_name= :userid  ");
$result1->bindParam(':userid', $p_name);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){
$qty=$row['qty2'];

$sql = "UPDATE loading 
        SET yard_before=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));


$sql = "UPDATE loading 
        SET unload_yard=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array('Payagala Yard',$id));



$sql = "UPDATE loading 
        SET unloading_time=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($j,$id));

}



}
}










$sql = "UPDATE loading SET action='unload' WHERE lorry_no ='$c'";
$q = $db->prepare($sql);
	$q->execute(array($qty,$c));
	
	
	$sql = "UPDATE lorry SET action='unload' WHERE lorry_no ='$c'";
$q = $db->prepare($sql);
	$q->execute(array($qty,$c));


header("location: unloading_view.php?d=$date&lorry_no=$c");





?>