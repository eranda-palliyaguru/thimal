<?php
session_start();
include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['products'];
$c = $_POST['qty'];
$yard = $_POST['yard'];

$date = $_POST['date'];
$discount = 0;

$result = $db->prepare("SELECT * FROM products WHERE  product_id= :userid ");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['gen_name'];


}

//edit qty
if($yard==1){
$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
}


if($yard==2){
$sql = "UPDATE products 
        SET qty2=qty2+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
}


// query
$sql = "INSERT INTO purchases_item (invoice,qty,name,cord,date) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$c,':c'=>$name,':d'=>$b,':e'=>$date));


header("location: purchase dis2.php?invoice=$a&date=$date&yard=$yard");


?>