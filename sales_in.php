<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$result = $db->prepare("SELECT * FROM collection   ORDER by transaction_id ASC LIMIT 0,1");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
$r1=$row['r1'];
$r2=$row['r2'];
$r3=$row['r3'];
$r4=$row['r4'];
$r5=$row['r5'];
$r6=$row['r6'];
$r7=$row['r7'];
$r8=$row['r8'];
$r9=$row['r9'];
$r10=$row['r10'];
$r11=$row['r11'];
$r12=$row['r12'];
$r13=$row['r13'];
$r14=$row['r14'];
$r15=$row['r15'];
$r16=$row['r16'];
$r17=$row['r17'];
$r18=$row['r18'];
$r19=$row['r19'];
$r20=$row['r20'];
$r21=$row['r21'];
$r22=$row['r22'];
$r23=$row['r23'];
$r24=$row['r24'];
$r25=$row['r25'];
		
					
				}

//echo $r1;

$result = $db->prepare("SELECT * FROM collection   ORDER by transaction_id ASC LIMIT 3,100000");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$ro=$row['r1'];
	switch ($r1) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				
							$ro=$row['r2'];
	switch ($r2) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
							
	$ro=$row['r3'];
	switch ($r3) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
	$ro=$row['r4'];
	switch ($r4) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
	$ro=$row['r5'];
	switch ($r5) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
	$ro=$row['r6'];
	switch ($r6) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r7'];
	            switch ($r7) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r8'];
	            switch ($r8) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r9'];
	            switch ($r9) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r10'];
	            switch ($r10) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r11'];
	            switch ($r11) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
				
				$ro=$row['r12'];
	            switch ($r12) {
			    case "Gas-12.5Kg":
				$d1= $ro;
				break;
				case "Gas-37.5Kg":
				$d2=$ro;
				break;
				case "Gas-5Kg":
				$d3=$ro;
				break;
				case "Gas-2Kg":
				$d4=$ro;
				break;	
				case "Cylinder-12.5Kg":
				$d5= $ro;
				break;
				case "Cylinder-37.5Kg":
				$d6=$ro;
				break;
				case "Cylinder-5Kg":
				$d7=$ro;
				break;
				case "Cylinder-2Kg":
				$d8=$ro;
				break;
				}
			
			
			 

echo $d1." / ".$d2." / ".$d3." / ".$d4." / ".$d5;

echo "<br>";
	
	$customer=$row['customer'];
	$invoice=1250001;
	$date=$row['date'];
	$lorry=$roe['lorry_no'];
	
	$sql = "INSERT INTO sales_order (invoice,customer,12_5kg_gas,37_5kg_gas,5kg_gas,2kg_gas,12_5kg_cylinders,37_5kg_cylinders,5kg_cylinders,2kg_cylinders,date,lorry_no,root,term,area) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invoice,':b'=>$customer,':c'=>$d1,':d'=>$d2,':e'=>$d3,':f'=>$d4,':g'=>$d5,':h'=>$d6,':i'=>$d7,':j'=>$d8,':k'=>$date,':l'=>$lorry,':m'=>$lorry,':n'=>$lorry,':o'=>$lorry));
	
	
				}				

?>
