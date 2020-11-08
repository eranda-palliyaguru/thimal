<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$date = $_POST['date'];
$id = $_POST['id'];

$qty='2';

$sql = "UPDATE bank 
        SET chq_action=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$sql = "UPDATE bank 
        SET chq_action_date=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($date,$id));


header("location: chq_action.php");
?>