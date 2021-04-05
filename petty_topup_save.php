<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$lor="";
$source=0;
$chq_no=0;
$type = $_POST['type'];

$amount = $_POST['amount'];
$date=$_POST['date'];
$now = date("Y-m-d");

if ($now==$date) {
$comment="";
}else {
  $comment=$now;
}

if($type=="Cash"){
$source = $_POST['source'];
	$sql = "UPDATE loading
        SET cash_total=cash_total-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$source));

$resultz = $db->prepare("SELECT * FROM loading WHERE transaction_id='$source' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$lor=$rowz['lorry_no'];
}

}else{
	$chq_no = $_POST['chq_no'];
}


$sql = "UPDATE peti
        SET amount=amount+?
				WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,'1'));


$resultz = $db->prepare("SELECT * FROM peti WHERE id='1'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$ba=$rowz['amount'];
}


$mt=1;
$acc=1;
//echo $customer_name;

$sql = "INSERT INTO expenses_records (date,type,chq_no,amount,balance,loading_id,lorry_no,m_type,account,comment) VALUES (:date,:a,:b,:amount,:ba,:so,:lo,:mt,:acc,:comm)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':b'=>$chq_no,':date'=>$date,':amount'=>$amount,':ba'=>$ba,':so'=>$source,':lo'=>$lor,':mt'=>$mt,':acc'=>$acc,':comm'=>$comment));


header("location: petty.php");

?>
