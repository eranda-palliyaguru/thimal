<?php
session_start();
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//echo $r_data[0];
$invoice_no=$_POST['invoice_no'];





$result = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invoice_no' ORDER by transaction_id DESC limit 0,1 ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $total=$row['amount'];
    $vat=($total/118)*18;
    $sub_total=$total-$vat;

    $result_array[] = array ("invoice_no" => $row['invoice_number'],
    "sales_id" => $row['transaction_id'],
    "name" => $row['name'],
    "date" => $row['date'],
    "time" => $row['time'],
    "loading_id" => $row['loading_id'],
    "rep"=>$row['rep'],
    "cus_vat" => $row['cus_vat_no'],
    "vat_action" => $row['vat_action'],
    "address"=>$row['address'],
    "action" => 'ok',
    "lorry_no" => $row['lorry_no'],
    "total" =>number_format($total,2),
    "vat"=>number_format($vat,2),
    "sub_total"=>number_format($sub_total,2));
 }
 

 





echo (json_encode ( $result_array ));

?>