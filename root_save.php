<?php
session_start();
include('connect.php');
$a = $_POST['root_name'];
$b = $_POST['area'];


// query
$sql = "INSERT INTO root (root_name,root_area) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b));
header("location: root.php");


?>