<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['invoice'];
$b = 'Laugfs Gas PLC';
$c = 0;
$date =date("Y/m/d");

// query
$sql = "INSERT INTO purchases (invoice_number,date,suplier,yard) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$date,':c'=>$b,':d'=>$c));




$a = $_POST['invoice'];
$yard = 0;
$lorry = $_POST['lorry'];

$rep = $_POST['rep'];
$root = $_POST['root'];

////*** UPDATE Lorry action *****//
$act='load';
$sql = "UPDATE lorry
       SET action=?
	WHERE lorry_no=?";
$q = $db->prepare($sql);
$q->execute(array($act,$lorry));
//********** ./ ****************//



$result1 = $db->prepare("SELECT * FROM loading WHERE  lorry_no=:userid AND rep ='Purchases' AND action='load' ");
$result1->bindParam(':userid', $lorry);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){
$b = $row['product_code'];
$c = $row['qty'];
$transaction_id = $row['transaction_id'];
	
//*** UPDATE loading action *****//
//$act='unload';
$sql = "UPDATE loading 
        SET rep=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($rep,$transaction_id));
	
	
	
$sql = "UPDATE loading 
        SET root=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($root,$transaction_id));
//********** ./ ****************//


$discount = 0;
$result = $db->prepare("SELECT * FROM products WHERE  product_id= :userid ");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['gen_name'];
}
// query
$sql = "INSERT INTO purchases_item (invoice,qty,name,cord,date) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$c,':c'=>$name,':d'=>$b,':e'=>$date));
//#############################################################################################################//

//###############################################  Refil gas ##################################################//
$b=$b-4;
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

	
$action='load';	
	
	
	$term=0;
$result = $db->prepare("SELECT * FROM loading WHERE lorry_no= :userid AND action='unload' AND date='$date' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$term=$row['term'];
}
$term=$term+1;
	$j1 = date("Y/m/d_h:i:sa");
	$k = 'Laugfs Gas PLC';
	
	$sql = "INSERT INTO loading (root,product_code,qty,lorry_no,rep,term,product_name,date,action,qty_sold,load_yard,loading_time) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$root,':b'=>$b,':c'=>$c,':d'=>$lorry,':e'=>$rep,':f'=>$term,':g'=>$name,':h'=>$date,':i'=>$action,':j'=>$c,':k'=>$k,':l'=>$j1));

	
	
	

}

header("location: purchase dis2.php?invoice=$a&date=$date&yard=$yard");


?>