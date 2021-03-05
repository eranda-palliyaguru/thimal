
<?php
session_start();
include("connect.php");
date_default_timezone_set("Asia/Colombo");

$cus_id=$_POST['cus_id'];
$u_name=$_SESSION['SESS_FIRST_NAME'];
$uid=$_SESSION['SESS_MEMBER_ID'];



$result = $db->prepare("SELECT * FROM user WHERE id='$uid' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$mid=$row['EmployeeId'];
		}

$result = $db->prepare("SELECT * FROM loading WHERE driver='$mid' and action='load' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$lorry=$row['lorry_no'];
$loading_id=$row['transaction_id'];
		}
//##############################//
$invo=$loading_id.date("dhHis");
//############################//
$result = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$cus=$row['customer_name'];
$add=$row['address'];
$price12=$row['price_12'];
$price37=$row['price_37'];
$price5=$row['price_5'];
$price2=$row['price_2'];
		}


$result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$pro_id=$row['product_id'];
$name=$row['gen_name'];
$price=$row['price'];
$o_price=$row['o_price'];
$price_id=$row['price_id'];
$sell_price=$row['sell_price'];
$sp_id="";

if ($pro_id==3) {
if ($price37==1) {
$price=$sell_price;
}
}



$result35 = $db->prepare("SELECT * FROM special_price WHERE product_id='$pro_id' and customer_id='$cus_id' ORDER by id DESC ");
		$result35->bindParam(':userid', $res);
		$result35->execute();
		for($i=0; $row35 = $result35->fetch(); $i++){
$sp_id=$row35['id'];
$sp_price=$row35['price'];
		}

if($sp_id>0){$price=$sp_price;}

			$qty=0;

$result2 = $db->prepare("SELECT * FROM loading_list WHERE loading_id='$loading_id' and action='load' and  product_code='$pro_id'  ");
		$result2->bindParam(':userid', $res);
		$result2->execute();
		for($i=0; $row2 = $result2->fetch(); $i++){

$qty=$_POST[$pro_id];
		}
$amount=$price*$qty;
$profit=$price-$o_price;
$profit=$profit*$qty;
$date=date("Y-m-d");

if($qty>0){
$action=3;

$sql = "INSERT INTO sales_list (product_id,name,qty,price,amount,profit,date,invoice_no,loading_id,action,cus_id,price_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:invo,:loid,:ac,:cus,:pid)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$pro_id,':b'=>$name,':c'=>$qty,':d'=>$price,':e'=>$amount,':f'=>$profit,':g'=>$date,':invo'=>$invo,':loid'=>$loading_id,':ac'=>$action,':cus'=>$cus_id,':pid'=>$price_id));
}
		}

$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invo'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$total=$row1['sum(amount)'];
		}

$result1 = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no='$invo'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$tot_profit=$row1['sum(profit)'];
		}

$sql = "INSERT INTO sales (invoice_number,cashier,date,amount,balance,profit,name,lorry_no,loading_id,customer_id,rep,address) VALUES (:a,:b,:c,:d,:d,:e,:f,:g,:lo,:cus,:rep,:add)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$invo,':b'=>$mid,':c'=>$date,':d'=>$total,':e'=>$tot_profit,':f'=>$cus,':g'=>$lorry,':lo'=>$loading_id,':cus'=>$cus_id,':rep'=>$u_name,':add'=>$add));

header("location: sales_pay.php?id=$invo");
?>
