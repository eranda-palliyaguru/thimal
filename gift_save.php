<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$a = $_POST['voucher_no'];
$b = $_POST['customer'];
$c = $_POST['nic_no'];
$g = $_POST['contract_no'];
$d = $_POST['product'];
$e = $_POST['date'];
$f = $_POST['location'];
$h = date("Y/m/d");
$ii =$_POST['comment'];
$j = 'Processing';
$one=1;
$gas=0;
//<<<<<<<<<<<<<<<<<<<<<<<<<< if qty 12.5 gas  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="12.5kg cylinder with gas"){

//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$gas=1;
    $empty=5;
//--------------------------------
     $qty1="qty";
     $qty2="qty";	 
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$gas=1;
    $empty=5;
//--------------------------------
     $qty1="qty2";
     $qty2="qty2";	
	}	
	}



//<<<<<<<<<<<<<<<<<<<<<<<<<< if qty 12.5 empty  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="12.5kg cylinder"){

//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$gas='';
    $empty=5;
//--------------------------------
     $qty1="qty";
     $qty2="cost";

	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$gas='';
    $empty=5;
//--------------------------------
     $qty1="qty2";
     $qty2="cost";
//--------------------------------

	}	
}

//<<<<<<<<<<<<<<<<<<<<<<<<<< if qty 5kg gas  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="5kg cylinder with gas"){

//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$gas=2;
    $empty=6;
//--------------------------------
     $qty1="qty";
     $qty2="qty";	
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$gas=2;
    $empty=6;
//--------------------------------
     $qty1="qty2";
     $qty2="qty2";	
	}	
}



//<<<<<<<<<<<<<<<<<<<<<<<<<< if qty 5kg empty  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if($d=="5kg cylinder"){

//################# kaluthara    ######################	
	if($f=="Kaluthara Yard"){
	$gas='';
    $empty=6;
//--------------------------------
     $qty1="qty";
     $qty2="cost";
//--------------------------------
	}	
//################  Payagala  ###########################	
	if($f=="Payagala Yard"){
	$gas='';
    $empty=6;
//--------------------------------
     $qty1="qty2";
     $qty2="cost";
	}	
}

//##############################################################################################################################################







$sql = "UPDATE products 
        SET $qty2=$qty2-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET $qty1=$qty1-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));


$sql = "UPDATE products 
        SET voucher=voucher+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));


$sql = "UPDATE products 
        SET voucher=voucher+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));




$sql = "INSERT INTO gift_voucher (voucher_no,customer_name,nic_no,contract_no,product,issued_date,location,date,comment,type) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$g,':e'=>$d,':h'=>$h,':f'=>$e,':g'=>$f,':i'=>$ii,':j'=>$j));

header("location: gift_view.php");

// query



?>