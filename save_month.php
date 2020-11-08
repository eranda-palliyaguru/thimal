<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

//$a = $_POST['invoice'];



$result1 = $db->prepare("SELECT * FROM customer WHERE  type='2' ORDER by customer_id DESC limit 0,200 ");
$result1->bindParam(':userid', $lorry);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$customer_name = $row1['customer_name'];
$address = $row1['address'];
$contact = $row1['contact'];
$customer_id = $row1['customer_id'];

/// query
$sql = "INSERT INTO month (cus,addr,cus_id,phone) VALUES (:a,:b,:d,:p)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$customer_name,':b'=>$address,':d'=>$customer_id,':p'=>$contact));

$A1=0;$B1=0;	
//echo $customer_name;

for($month = 0; $month <32; $month++ ) {
$month=$month+1;
if($month<10){$day="0".$month;}else{$day=$month;}	
	
$d1="2020-02-".$day;	
	
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date = '$d1'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '3'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$A=$rowz['sum(qty)'];
	
$col=$month+1 ."a";

$sql = "UPDATE month 
        SET $col=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($A,$customer_id));
	
$A1+=$A;	
}

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '1'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$B=$rowz['sum(qty)'];
	
	
$col=$month+1 ."b";

$sql = "UPDATE month 
        SET $col=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($B,$customer_id));

$B1+=$B;
	
}
	
}
	
}
		
$sql = "UPDATE month 
        SET tot_a=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($A1,$customer_id));
	
$sql = "UPDATE month 
        SET tot_b=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($B1,$customer_id));

}

//header("location: purchase dis2.php?invoice=$a&date=$date&yard=$yard");


?>