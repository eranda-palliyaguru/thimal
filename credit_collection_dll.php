<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_GET['id'];
$loading_id=$_GET['lid'];
$qty=5;
$sql = "UPDATE collection
        SET action=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));



header("location: loading_view.php?id=$loading_id");

?>
