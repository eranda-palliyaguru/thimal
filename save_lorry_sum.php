<?php 
date_default_timezone_set("Asia/Colombo");
include('connect.php');

$r5000=$_REQUEST['r5000'];
$r2000=$_REQUEST['r2000'];
$r1000=$_REQUEST['r1000'];
$r500=$_REQUEST['r500'];
$r100=$_REQUEST['r100'];
$r50=$_REQUEST['r50'];
$r20=$_REQUEST['r20'];
$r10=$_REQUEST['r10'];
$coin=$_REQUEST['coin'];
$total=$_REQUEST['total'];

$id=$_REQUEST['id'];
//$id="483";

$sql = "UPDATE loading 
        SET r5000=?,r2000=?,r1000=?,r500=?,r100=?,r50=?,r20=?,r10=?,coins=?,cash_total=?
		WHERE transaction_id=? ";
$q = $db->prepare($sql);
$q->execute(array($r5000,$r2000,$r1000,$r500,$r100,$r50,$r20,$r10,$coin,$total,$id));

header("location: sales_start.php");
?>