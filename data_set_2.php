<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	<?php 
	date_default_timezone_set("Asia/Colombo");
include('connect.php');

	$result = $db->prepare("SELECT * FROM sales_list WHERE lorry_id='0' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];
$loading_id=$row['loading_id'];
	
			
$result1 = $db->prepare("SELECT * FROM loading WHERE  transaction_id='$loading_id'  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $lorry_id=$row1['lorry_id'];
				}	
		
$sql = "UPDATE sales_list 
        SET lorry_id=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($lorry_id,$id));
			
			
		
		}
	
	?>
	
	
</body>
</html>