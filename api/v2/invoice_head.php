<?php
session_start();
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//echo $r_data[0];
$user=$_POST['user_id'];





$result = $db->prepare("SELECT * FROM sales WHERE cashier='$user' ORDER by transaction_id DESC limit 0,1 ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $result_array = array ("invoice_no" => $row['transaction_id'],
    "name" => $row['name'],
    "date" => $row['date'],
    "time" => $row['time'],
    "loading_id" => $row['loading_id'],
    "rep"=>$row['rep'],
    "cus_vat" => $row['cus_vat_no'],
    "action" => 'ok',
    "lorry_no" => $row['lorry_no']);
 }
 

 





echo (json_encode ( $result_array ));

?>