<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$a = $_POST['root'];
$b = $_POST['product'];
$c = $_POST['lorry'];
$e = $_POST['rep'];
$f = $_POST['qty'];

//$d = $_POST['terms'];
$j = date("Y/m/d");
$j1 = date("Y/m/d_h:i:sa");
$k = "load";
$l = $_POST['qty'];
$yard=$_POST['yard'];






$term=0;
$result = $db->prepare("SELECT * FROM loading WHERE lorry_no= :userid AND action='unload' AND date='$j' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$term=$row['term'];
}
//$$$$$$$$$$$$$$$$         edit terms      $$$$$$$$$$$$$$$$$$$$$$$
if($term>=1){
$d=$term+1;
}
else{
	$d=1;
}
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


$empty=0;
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$h=$row['profit'];
$ii=$row['gen_name'];
$empty=$row['product_name'];
}



$act='load';

$sql = "UPDATE lorry 
        SET action=?
		WHERE lorry_no=?";
$q = $db->prepare($sql);
$q->execute(array($act,$c));




//###################################     edit qty      #################################


if($yard==1){
	$yard1='Kaluthara Yard';
	
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$b));
// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty'];	
}
}

if($yard==2){
	
	$yard1='Payagala Yard';
	
$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$b));	
// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty2'];	
}
}

if($yard==3){
	
	$yard1='Other Yard';
	
$sql = "UPDATE products 
        SET qty3=qty3-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$b));	
// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty3'];	
}
}
//##########################################################################################










$g=$asasa;
// query
$sql = "INSERT INTO loading (root,product_code,qty,price,lorry_no,rep,term,profit,product_name,date,action,qty_sold,load_yard,loading_time,load_yard_before) VALUES (:a,:b,:f,:g,:c,:e,:d,:h,:i,:j,:k,:l,:m,:j1,:n)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$ii,':j'=>$j,':k'=>$k,':l'=>$l,':m'=>$yard1,':j1'=>$j1,':n'=>$qty_af));



if($empty>=1){
	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $empty);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$h=$row['profit'];
$ii=$row['gen_name'];

}



//###################################     edit qty      #################################


if($yard==1){
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$empty));
	
// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $empty);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty'];	
}	
}

	
	
	
if($yard==2){
$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$empty));	
	// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $empty);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty2'];	
}
}
	
	
	if($yard==3){
$sql = "UPDATE products 
        SET qty3=qty3-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$empty));
// arfter yard qty	
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $empty);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_af=$row['qty3'];	
}
}
//##########################################################################################
	
	
	
$sql = "INSERT INTO loading (root,product_code,qty,price,lorry_no,rep,term,profit,product_name,date,action,qty_sold,load_yard,load_yard_before) VALUES (:a,:b,:f,:g,:c,:e,:d,:h,:i,:j,:k,:l,:m,:n)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$empty,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$ii,':j'=>$j,':k'=>$k,':l'=>$l,':m'=>$yard1,':n'=>$qty_af));
	
}



header("location: unload_loading2.php?root=$a&lorry=$c&rep=$e&yard=$yard");


?>