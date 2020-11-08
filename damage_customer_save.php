<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['complain_no'];
$b ='Custemor';
$c= date('Y/m/d');

$d='Complete';
$e='Delivery to Customer';


$result = $db->prepare("SELECT * FROM damage WHERE  complain_no='$a'  ");
		$result->bindParam(':userid', $a);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){

		$ttype=$row['cylinder_type'];

		
		}
		
		
		
		$result = $db->prepare("SELECT * FROM products WHERE  gen_name='$ttype'  ");
		$result->bindParam(':userid', $a);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){

		$id=$row['product_id'];

		
		}
$iv=1;




$sql = "UPDATE products
        SET damage=damage-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($iv,$id));




//edit qty
$sql = "UPDATE damage 
        SET date=?
		WHERE complain_no=?";
$q = $db->prepare($sql);
$q->execute(array($c,$a));


$sql = "UPDATE damage 
        SET action=?
		WHERE complain_no=?";
$q = $db->prepare($sql);
$q->execute(array($e,$a));


$sql = "UPDATE damage 
        SET type=?
		WHERE complain_no=?";
$q = $db->prepare($sql);
$q->execute(array($d,$a));


$sql = "UPDATE damage 
        SET location=?
		WHERE complain_no=?";
$q = $db->prepare($sql);
$q->execute(array($b,$a));





// query
$sql = "INSERT INTO damage_order (complain_no,location,date,type,action) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e));
header("location: damage_view.php");


?>