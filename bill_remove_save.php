<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$invoice=$_POST['invoice'];
$reason=$_POST['reason'];

$user=$_SESSION['SESS_MEMBER_ID'];
$A1=1;

$sql = "UPDATE sales
        SET reason=?, remove=?, remove_user=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($reason,$A1,$user,$invoice));


header("location: bill_remove.php");
?>
