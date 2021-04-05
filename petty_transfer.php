<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$amount = $_POST['amount'];
$from=$_POST['from'];
$to=$_POST['to'];
$date=$_POST['date'];
$now=date('Y-m-d');
if ($now==$date) {
$comment="";
}else {
  $comment=$now;
}


//-----------------------------------from------------------------------------//

$sql = "UPDATE peti
        SET amount=amount-?
        WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$from));

$resultz = $db->prepare("SELECT * FROM peti   WHERE id='$from' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$ba=$rowz['amount'];
}
$mt=2;
$type="Transfer from";

$sql = "INSERT INTO expenses_records (date,type,amount,balance,comment,m_type,account) VALUES (:date,:a,:amount,:ba,:comm,:mt,:acc)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':date'=>$date,':amount'=>$amount,':ba'=>$ba,':comm'=>$comment,':mt'=>$mt,':acc'=>$from));

///---------------------------------------to------------------------------//
$sql = "UPDATE peti
        SET amount=amount+?
        WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$to));

$resultz = $db->prepare("SELECT * FROM peti   WHERE id='$to' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$ba=$rowz['amount'];
}
$mt=1;
$type="Transfer to";

$sql = "INSERT INTO expenses_records (date,type,amount,balance,comment,m_type,account) VALUES (:date,:a,:amount,:ba,:comm,:mt,:acc)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':date'=>$date,':amount'=>$amount,':ba'=>$ba,':comm'=>$comment,':mt'=>$mt,':acc'=>$to));


header("location: petty.php");

?>
