<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");
$time = date("h:i:sa");
$k = "load";

$lorry_id=$_POST['lorry'];
$driver=$_POST['driver'];

$helper1=$_POST['h1'];
$helper2=$_POST['h2'];


$root=0;
$root_id=0;

$result = $db->prepare("SELECT * FROM lorry WHERE lorry_id= :userid");
$result->bindParam(':userid', $lorry_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$lorry=$row['lorry_no'];
}


$result = $db->prepare("SELECT * FROM user WHERE EmployeeId= :userid");
$result->bindParam(':userid', $driver);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$uid=$row['id'];
}



$term=0;
$result = $db->prepare("SELECT * FROM loading WHERE lorry_id= :userid AND action='load' ");
$result->bindParam(':userid', $lorry_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tran=$row['transaction_id'];
}
//$$$$$$$$$$$$$$$$         edit terms      $$$$$$$$$$$$$$$$$$$$$$$
if($tran>=1){
echo $lorry." දරන ලොරිය සදහ දැනටමත් loading එකක් තිබෙන බැවින් පලමුව එම loading එක unload කරන්න";
}
else{
$empty=0;

$g=$asasa;
// query
$sql = "INSERT INTO loading (lorry_no,lorry_id,root,root_id,date,action,loading_time,driver,helper1,helper2) VALUES (:a,:b,:c,:d,:e,:f,:g,:dr,:h1,:h2)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$lorry,':b'=>$lorry_id,':c'=>$root,':d'=>$root_id,':e'=>$date,':f'=>$k,':g'=>$time,':dr'=>$driver,':h1'=>$helper1,':h2'=>$helper2));



	
$result = $db->prepare("SELECT * FROM loading WHERE lorry_id= :userid AND action='load' ");
$result->bindParam(':userid', $lorry_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tran=$row['transaction_id'];
}

	
$action="load";	
$sql = "UPDATE lorry 
        SET action=?
		WHERE lorry_id=?";
$q = $db->prepare($sql);
$q->execute(array($action,$lorry_id));	
	
$sql = "UPDATE lorry 
        SET loading_id=?
		WHERE lorry_id=?";
$q = $db->prepare($sql);
$q->execute(array($tran,$lorry_id));
	

	
$sql = "UPDATE lorry 
        SET user_id=?
		WHERE lorry_id=?";
$q = $db->prepare($sql);
$q->execute(array($uid,$lorry_id));
	
	
header("location: loading2.php?id=$tran");
}

?>