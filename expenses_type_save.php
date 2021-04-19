<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$date1=date("Y-m-d");
$name=$_POST['name'];

$sql = "INSERT INTO expenses_types (type_name) VALUES (?)";
$q = $db->prepare($sql);
$q->execute(array($name));

header("location: expenses.php");
 ?>
