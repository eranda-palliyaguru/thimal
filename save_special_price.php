<?php

session_start();

include('connect.php');
$cus_id = $_POST['cus'];
$price = $_POST['price'];
$pro_id = $_POST['pro_id'];
//$g = $_POST['root'];

$result = $db->prepare("SELECT * FROM customer WHERE  customer_id= :userid ");
$result->bindParam(':userid', $cus_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cus_id=$row['customer_id'];
$cus_name=$row['customer_name'];
}

$result = $db->prepare("SELECT * FROM products WHERE  product_id='$pro_id'   ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$pro_name=$row['gen_name'];
$n_price=$row['price'];

}


// query

$sql = "INSERT INTO special_price ( product_name ,product_id,price,n_price,customer,customer_id) VALUES (:a,:b,:c,:d,:e,:f)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$pro_name,':b'=>$pro_id,':c'=>$price,':d'=>$n_price,':e'=>$cus_name,':f'=>$cus_id));

header("location: special_price.php");





?>