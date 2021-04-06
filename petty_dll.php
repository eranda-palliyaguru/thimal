<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_GET['id'];


$resultz = $db->prepare("SELECT * FROM expenses_records WHERE  sn='$id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$a=$rowz['amount'];
$type=$rowz['type'];
$source=$rowz['loading_id'];
$account=$rowz['account'];
}


if($type=="Cash"){
	$sql = "UPDATE loading
        SET cash_total=cash_total+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$source));
}

$sql = "UPDATE peti
        SET amount=amount-?
        WHERE  id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$account));

$c="1";
$sql = "UPDATE expenses_records
        SET action=?
		WHERE  sn=?";
$q = $db->prepare($sql);
$q->execute(array($c,$id));







?>
