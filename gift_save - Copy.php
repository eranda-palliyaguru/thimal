<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$a = $_POST['voucher_no'];
$b = $_POST['customer'];
$c = $_POST['contract_no'];
$d = $_POST['product'];
$e = $_POST['date'];
$f = $_POST['location'];
$g = date("Y/m/d");
$one=1;
//<<<<<<<<<<<<<<<<<<<<<<<<<< if qry 12.5 gas  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="12.5kg cylinder with gas"){
$gas=1;
$empty=5;
//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));	
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty))	
	}	

	
	}



//<<<<<<<<<<<<<<<<<<<<<<<<<< if qry 12.5 empty  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="12.5kg cylinder"){
$gas=1;
$empty=5;
//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------

	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------

	}	
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//<<<<<<<<<<<<<<<<<<<<<<<<<< if qry 5kg gas  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="5kg cylinder with gas"){
$gas=2;
$empty=6;
//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));	
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty))	
	}	
}



//<<<<<<<<<<<<<<<<<<<<<<<<<< if qry 5kg empty  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="12.5kg cylinder"){
$gas=2;
$empty=6;
//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$sql = "UPDATE products 
        SET qty2=qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
	}	
}

//##############################################################################################################################################


$h = 'damage';
$ii=$_POST['gas_weight'];
$j=$_POST['comment'];

$ex="Register";

$sql = "UPDATE products 
        SET damage=damage+?
		WHERE gen_name=?";
$q = $db->prepare($sql);
$q->execute(array(1,$d));



$sql = "INSERT INTO damage (complain_no,customer_name,cylinder_no,cylinder_type,reason,location,date,action,gas_weight,comment,type) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':h'=>$ex,':f'=>$f,':g'=>$g,':i'=>$ii,':j'=>$j,':k'=>$h));



$sql = "INSERT INTO damage_order (complain_no,location,date,action,type) VALUES (:a,:f,:g,:h,:ex)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':f'=>$f,':g'=>$g,':h'=>$ex,':ex'=>$h));

header("location: damage_view.php");
exit();

// query



?>