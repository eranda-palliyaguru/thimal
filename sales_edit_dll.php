<?php
session_start();
include('connect.php');
$a = $_GET['id'];



$result = $db->prepare("SELECT * FROM sales_order WHERE  invoice='$a' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
//$id=$row['transaction_id'];
$term=$row['term'];
$lorry=$row['lorry_no'];
}


$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND term='$term' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['product_code'];
$tr=$row['transaction_id'];


$result1 = $db->prepare("SELECT * FROM products WHERE  product_id= :userid  ");
$result1->bindParam(':userid', $id);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){
echo $tebal_id=$row['tebal_id'];

}
$result1 = $db->prepare("SELECT * FROM sales_order WHERE  invoice='$a' ");
$result1->bindParam(':userid', $id);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){
echo $qty=$row[ $tebal_id];

}

$sql = "UPDATE loading 
        SET qty=qty+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$tr));


}


$result = $db->prepare("DELETE FROM sales_order WHERE  invoice= :memid");
	$result->bindParam(':memid', $a);
	$result->execute();










// query
header("location:sales_edit.php");


?>