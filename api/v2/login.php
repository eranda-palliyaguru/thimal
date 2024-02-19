<?php
session_start();
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//echo $r_data[0];
$user=$_POST['user'];
$password=$_POST['password'];



$action="not";
$name='';
$user_id=0;

$result = $db->prepare("SELECT * FROM user WHERE username='$user' AND password='$password' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $user_id=$row['EmployeeId'];
    $name=$row['name'];
    $action="ok";
 }
 

 $key=sha1(date('syihadm'));


    



$result_array = array ("action" => $action,
                       "user_id" => $user_id,
                       "name" => $name,
                       "key" => $key);


echo (json_encode ( $result_array ));

?>