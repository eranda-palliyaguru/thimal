<?php

session_start();

include('connect.php');

date_default_timezone_set("Asia/Colombo");



$a = $_POST['id'];

$f = $_POST['location'];



$d='Clear';





$e='Clear';

$gas=0;



$sql = "UPDATE trust 
        SET status=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($e,$a));




$result = $db->prepare("SELECT * FROM trust WHERE  transaction_id= :userid ");
$result->bindParam(':userid', $a);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$pr=$row['product'];
$pro_id=$row['product_id'];
}



$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$pro_id));

$sql = "UPDATE products 
        SET trust=trust-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$pro_id));





header("location: trust_view.php");





?>