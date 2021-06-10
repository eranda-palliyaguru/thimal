<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$a = "";
$b = $_POST['product'];
$id = $_POST['id'];
$e = "";
$f = $_POST['qty'];

//$d = $_POST['terms'];
$j = date("Y-m-d");
$time=date("h:i.a");
$j1 = date("Y-m-d_h:i:sa");
$k = "load";
$l = $_POST['qty'];
$yard="1";
$type=1;
$user_id=$_SESSION['SESS_MEMBER_ID'];




$term=0;
$result = $db->prepare("SELECT * FROM loading WHERE transaction_id='$id'  ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$c=$row['lorry_no'];
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
	$yard1='Main Yard';

$sql = "UPDATE products
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$b));
}

//##########################################################################################




$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$lob=$row['qty'];

}


$result = $db->prepare("SELECT * FROM loading_list WHERE product_code='$b' and loading_id='$id'");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$loading_list_id=$row['transaction_id'];
}



$g=$asasa;
// query
if (isset($loading_list_id)) {
	$sql = "UPDATE loading_list
	        SET qty=qty+?,qty_sold=qty_sold+?
			WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($f,$f,$loading_list_id));
}else {
	$sql = "INSERT INTO loading_list (product_code,qty,price,lorry_no,profit,product_name,date,action,qty_sold,loading_time,loading_id,load_yard_before) VALUES (:b,:f,:g,:c,:h,:i,:j,:k,:l,:j1,:m,:lb)";
	$q = $db->prepare($sql);
	$q->execute(array(':b'=>$b,':c'=>$c,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$ii,':j'=>$j,':k'=>$k,':l'=>$l,':j1'=>$j1,':m'=>$id,':lb'=>$lob));

}


$action=1;
$sql = "INSERT INTO stock_log (product_id,qty,product_name,date,time,action,source_id,yard_qty,type,user_id) VALUES (:b,:f,:i,:j,:ti,:k,:m,:lb,:ty,:us)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$b,':f'=>$f,':i'=>$ii,':j'=>$j,':k'=>$action,':m'=>$id,':lb'=>$lob,':ti'=>$time,':ty'=>$type,':us'=>$user_id));



if($empty>=1){
//###################################     edit qty      #################################
if($yard==1){
$sql = "UPDATE products
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$empty));
}

//##########################################################################################



$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $empty);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$h=$row['profit'];
$ii=$row['gen_name'];
$lob=$row['qty'];
}


$result = $db->prepare("SELECT * FROM loading_list WHERE product_code='$empty' and loading_id='$id'");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$loading_list_id_e=$row['transaction_id'];
}


if (isset($loading_list_id_e)) {
	$sql = "UPDATE loading_list
	        SET qty=qty+?,qty_sold=qty_sold+?
			WHERE transaction_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($f,$f,$loading_list_id_e));
}else {

$sql = "INSERT INTO loading_list (product_code,qty,price,lorry_no,profit,product_name,date,action,qty_sold,loading_id,load_yard_before) VALUES (:b,:f,:g,:c,:h,:i,:j,:k,:l,:m,:lb)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$empty,':c'=>$c,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$ii,':j'=>$j,':k'=>$k,':l'=>$l,':m'=>$id,':lb'=>$lob));
}


$action=1;
$sql = "INSERT INTO stock_log (product_id,qty,product_name,date,time,action,source_id,yard_qty,type,user_id) VALUES (:b,:f,:i,:j,:ti,:k,:m,:lb,:ty,:us)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$empty,':f'=>$f,':i'=>$ii,':j'=>$j,':k'=>$action,':m'=>$id,':lb'=>$lob,':ti'=>$time,':ty'=>$type,':us'=>$user_id));
}





header("location: loading2.php?id=$id");


?>
