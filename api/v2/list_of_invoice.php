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
    $total=$row['amount'];
    $vat=($total/118)*18;
    $sub_total=$total-$vat;

    $result_array[] = array ("invoice_no" => $row['invoice_number'],
    "name" => $row['name'],
    "date" => $row['date'],
    "time" => $row['time'],
    "lorry_no" => $row['lorry_no'],
    "rep"=>$row['rep'],
    "action" => 'ok',
    "total" =>number_format($total,2));
 }
 

 





echo (json_encode ( $result_array ));

?>