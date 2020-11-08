<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$a = $_POST['complain_no'];
$b = $_POST['customer'];
$c = $_POST['cylinder_no'];
$d = $_POST['product'];
$e = $_POST['reason'];
$f = $_POST['location'];
$g = date("Y/m/d");
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