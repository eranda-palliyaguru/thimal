<?php 
include 'DBConnection.php';

$districtId = $_GET['cashier'];
$act="1";

$db = DBConnection::getInstance ();
$db = DBConnection::getInstance ();
$mysqli = $db->getConnection ();

$quary  = "SELECT rep , amount , lorry_no , loading_id , date , address , invoice_number , transaction_id , name , id_type , id_number , time  ";
$quary .= "FROM sales ";
$quary .= "WHERE cashier = ".$districtId." AND action=".$act." ORDER by transaction_id DESC limit 0,1";

//echo $quary;

$formatted_array = array();

$result = $mysqli->query ( $quary );

while($row = mysqli_fetch_assoc ( $result )){
	array_push($formatted_array, $row);
}

echo (json_encode ( $formatted_array ));

?>
