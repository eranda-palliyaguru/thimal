<?php
session_start();
include('connect.php');
$id =$_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$acc_no = $_POST['acc_no'];
$acc_name = $_POST['acc_name'];
$phone_no = $_POST['phone_no'];
$type = $_POST['type'];
$group = $_POST['group'];
$credit_limit = $_POST['credit'];


$sql = "UPDATE customer 
        SET customer_name=?, address=?, contact=?,acc_name=?,acc_no=?,type=?,credit_period=?,category=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$address,$phone_no,$acc_name,$acc_no,$type,$credit_limit,$group,$id));




header("location: customer.php");


?>