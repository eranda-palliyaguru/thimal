<?php

session_start();

include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['products'];
$c = $_POST['qty'];



$date = $_POST['date'];
$discount = 0;


$result = $db->prepare("SELECT * FROM products WHERE  product_id= :userid ");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['gen_name'];
}


//edit qty



// query
$sql = "INSERT INTO purchases_item (invoice,qty,name,cord,date) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$c,':c'=>$name,':d'=>$b,':e'=>$date));


header("location: purchase2.php?invoice=$a&date=$date");





?>