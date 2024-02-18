<?php 
session_start();
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$invo=$_POST['invoice_no'];

$result = $db->prepare('SELECT * FROM payment WHERE  invoice_no=:id ');
$result->bindParam(':id', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $result_array[] = array (
        "type" => $row['type'],
        "amount" => $row['amount'],
        "chq_no" =>$row['chq_no'],
        'bank' =>$row['bank']
        
);
}

echo json_encode($result_array);