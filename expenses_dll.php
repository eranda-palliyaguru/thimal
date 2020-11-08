<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
 
$id=$_GET['id'];


$resultz = $db->prepare("SELECT * FROM expenses_records WHERE  sn='$id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$a=$rowz['amount'];
$mt=$rowz['m_type'];
}

if($mt<3){
$sql = "UPDATE peti 
        SET amount=amount+?";
$q = $db->prepare($sql);
$q->execute(array($a));
}

$c="1";
$sql = "UPDATE expenses_records 
        SET action=?
		WHERE  sn=?";
$q = $db->prepare($sql);
$q->execute(array($c,$id));













?>