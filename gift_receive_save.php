<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['voucher_no'];
$b = $_POST['yard'];
$c= date('Y/m/d');
$d='Clear';


$e='Receiv Yard';
$gas=0;


//edit qty
$sql = "UPDATE gift_voucher 
        SET type=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($d,$a));

$sql = "UPDATE gift_voucher 
        SET date=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$a));


$sql = "UPDATE gift_voucher 
        SET location=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$a));


$result = $db->prepare("SELECT * FROM gift_voucher WHERE  transaction_id= :userid ");
$result->bindParam(':userid', $a);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$d=$row['product'];
$f=$row['location'];
}


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



$one=1;



$sql = "UPDATE products 
        SET $qty2=$qty2+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));
//--------------------------------
$sql = "UPDATE products 
        SET $qty1=$qty1+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));


$sql = "UPDATE products 
        SET voucher=voucher-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$empty));


$sql = "UPDATE products 
        SET voucher=voucher-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($one,$gas));


header("location: gift_view.php");


?>