<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$date1=date("Y-m-d");
$name=$_POST['name'];
$type_id=$_POST['type'];


$result = $db->prepare("SELECT * FROM expenses_types WHERE sn='$type_id' ");
$result->bindParam(':userid', $ttr);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$type=$row['type_name'];
}

$sql = "INSERT INTO expenses_sub_type (name,type_id,type) VALUES (?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name,$type_id,$type));

header("location: expenses.php");
 ?>
