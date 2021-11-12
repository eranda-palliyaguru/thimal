<?php
session_start();
include('connect.php');
$name = $_POST['rep_name'];
$type = $_POST['type'];
$contect = $_POST['content'];

$user = $_POST['user'];
$password = $_POST['password'];



$sql = "INSERT INTO employee (name,phone_no,type,action) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$name,':b'=>$contect,':c'=>$type,':d'=>"1"));

   $result = $db->prepare("SELECT * FROM employee WHERE action='1' AND name='$name'  ORDER by id DESC limit 1  ");
   $result->bindParam(':userid', $date);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $emp=$row['id']; }


// query
$sql = "INSERT INTO user (username,password,name,position,employeeid) VALUES (?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($user,$password,$name,"lorry",$emp));

header("location: rep.php");


?>
