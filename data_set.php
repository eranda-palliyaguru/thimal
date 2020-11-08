<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$cus='3';
$invo="LAUGFS Gas PLC";

$sql = "UPDATE bank 
        SET type=?
		WHERE receive=?";
$q = $db->prepare($sql);
$q->execute(array($cus,$invo));
	

				



?>