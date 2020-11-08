<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$a="Laugfs Gas PLC";
$product = $_POST['product'];
$lorry = $_POST['lorry'];
$qty = $_POST['qty'];
$e="Purchases";
$j = date("Y/m/d");
$j1 = date("Y/m/d_h:i:sa");
$k = "load";
$yard=$_POST['yard'];






$term=0;
$result = $db->prepare("SELECT * FROM loading WHERE lorry_no= :userid AND action='unload' AND date='$j' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$term=$row['term'];
}
//$$$ edit terms $$$$$$//
if($term>=1){
$d=$term+1;
}
else{
$d=1;
}
//$$$$$$$$$$$$$$$$$$$$//


$empty=0;
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $product);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$h=$row['profit'];
$ii=$row['gen_name'];
$empty=$row['product_name'];
}


// ***** UPDATE lorry Action ***//
$act='Purchases';
$sql = "UPDATE lorry 
        SET action=?
		WHERE lorry_no=?";
$q = $db->prepare($sql);
$q->execute(array($act,$lorry));
//********* ./ ****************//



//###################################     edit qty      #################################
if($yard==1){
$yard1='Kaluthara Yard';	
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product));
}

if($yard==2){	
$yard1='Payagala Yard';	
$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product));	
}


if($yard==3){
$yard1='Payagala Yard';	
$sql = "UPDATE products 
        SET qty3=qty3-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product));	
}
//##########################################################################################


$g=$asasa;
// query
$sql = "INSERT INTO loading (root,product_code,qty,price,lorry_no,rep,term,profit,product_name,date,action,qty_sold,load_yard,loading_time) VALUES (:a,:b,:f,:g,:c,:e,:d,:h,:i,:j,:k,:f,:m,:j1)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$product,':c'=>$lorry,':d'=>$d,':e'=>$e,':f'=>$qty,':g'=>$g,':h'=>$h,':i'=>$ii,':j'=>$j,':k'=>$k,':m'=>$yard1,':j1'=>$j1));

header("location: emty_loading2.php?lorry=$lorry&yard=$yard");


?>