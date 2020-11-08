<?php
session_start();
include('connect.php');
$invo = $_POST['invo'];
$id = $_POST['id'];
$qty = $_POST['qty'];
$pro = $_POST['products'];


$result = $db->prepare("SELECT * FROM loading WHERE  transaction_id= :userid  ");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

}

$result = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$cus_id=$row['customer_id'];
$date=$row['date'];
		}


$result = $db->prepare("SELECT * FROM products WHERE product_id='$pro' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$pro_id=$row['product_id'];
$name=$row['gen_name'];
$price=$row['price'];
$o_price=$row['o_price'];
		}
$sp_id="0";
$result = $db->prepare("SELECT * FROM special_price WHERE product_id='$pro' and customer_id='$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$sp_id=$row['id'];
$sp_price=$row['price'];
		}

if($sp_id>0){$price=$sp_price;}

			
$amount=$price*$qty;
$profit=$price-$o_price;
$profit=$profit*$qty;

$act=3;

//------------------------------------------------------------------------------//

$sql = "INSERT INTO sales_list (product_id,name,qty,price,amount,profit,date,invoice_no,loading_id,action) VALUES (:a,:b,:c,:d,:e,:f,:g,:invo,:loid,:act)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$pro_id,':b'=>$name,':c'=>$qty,':d'=>$price,':e'=>$amount,':f'=>$profit,':g'=>$date,':invo'=>$invo,':loid'=>$id,':act'=>$act));


header("location:biling.php?id=$id&invo=$invo");


?>