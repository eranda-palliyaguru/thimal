<?php
include 'DBConnection.php';

$districtId = $_GET['invoice_no'];

$db = DBConnection::getInstance ();
$db = DBConnection::getInstance ();
$mysqli = $db->getConnection ();

$quary  = "SELECT amount , type , bank , chq_date , chq_no ";
$quary .= "FROM payment ";
$quary .= "WHERE invoice_no = ".$districtId;

//echo $quary;

$formatted_array = array();

$result = $mysqli->query ( $quary );

while($row = mysqli_fetch_assoc ( $result )){
	array_push($formatted_array, $row);
}

echo (json_encode ( $formatted_array ));

?>
