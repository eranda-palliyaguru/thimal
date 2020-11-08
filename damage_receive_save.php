<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$a = $_POST['complain_no'];
$b = $_POST['yard'];
$c= date('Y/m/d');
$d='Clear';


$e='Receiv Yard';



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