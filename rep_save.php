<?php
session_start();
include('connect.php');
$a = $_POST['rep_name'];
$b = $_POST['address'];
$c = $_POST['content'];






// query
$sql = "INSERT INTO rep (rep_name,rep_address,contact_no) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: rep.php");


?>