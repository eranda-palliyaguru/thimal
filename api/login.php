<?php

include 'DBConnection.php';

$db = DBConnection::getInstance ();
$mysqli = $db->getConnection ();

$username = $_POST ['username'];
$password = $_POST ['password'];


$quary  = "SELECT username,  password, EmployeeId, id ";
$quary .= "FROM user ";
$quary .= "WHERE username= '" . $username . "' AND password = '" . $password . "' ";



$formatted_array = array();

$result = $mysqli->query ( $quary );

while($row = mysqli_fetch_assoc ( $result )){
	array_push($formatted_array, $row);
}

if (count ( $formatted_array ) == 1 && strcmp($formatted_array[0]['username'],$username) == 0
		&& strcmp($formatted_array [0]['password'],$password) == 0) {

	$employeeID = $formatted_array [0]['EmployeeId'];
	$employeeName = $formatted_array[0]['username'];
	$userID = $formatted_array [0]['id'];

	



		$result_array = array (
				"message" => "Login successful",
				"employee_id" => $employeeID,
				"employee_name"=> $employeeName,
				"user_id" => $userID
		);
	
	
	echo (json_encode ( $result_array ));

} else {
	
	$result_array = array (
			"message" => "Login failed"
	);

	echo (json_encode ( $result_array ));
}


?>