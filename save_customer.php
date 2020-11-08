<?php

session_start();

include('connect.php');
$a = $_POST['customer_name'];
$b = $_POST['address'];

$c = $_POST['contact'];

$g = $_POST['root'];





$result = $db->prepare("SELECT * FROM root WHERE  root_name= :userid ");

$result->bindParam(':userid', $g);

$result->execute();

for($i=0; $row = $result->fetch(); $i++){

$d=$row['root_area'];



}





$g1=2;



// query

$sql = "INSERT INTO customer (customer_name,address,contact,area,root,type) VALUES (:a,:b,:c,:d,:e,:e1)";

$q = $db->prepare($sql);

$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$g,':e1'=>$g1));

header("location: gps2.php");





?>