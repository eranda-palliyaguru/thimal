<?php
session_start();
include('connect.php');
$a = $_POST['lorry_no'];
$b = $_POST['driver'];
$c='unload';






// query
$sql = "INSERT INTO lorry (lorry_no,driver,action) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: lorry.php");


?>