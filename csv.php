<?php


class csv extends mysqli
{
	private $state_csv = false;
	public function __construct()
	{
		parent::__construct("localhost","colorb69_1","rathunona1.","colorb69_family");
		if ($this->connect_error) {

			echo "Fail to connection_timeout".$this->connect_error;

		}
	}
public function inport($file)
{
	$file = fopen($file, 'r');

	while( ($row = fgetcsv($file,1000,",")) !==false) {

		$r=$row [1];
		$r1=$row [2];
		$r2=$row [3];
		$r3=$row [4];
		$r4=$row [5];
		$r5=$row [6];
		$r6=$row [7];
		$r7=$row [8];
		$r8=$row [9];
		$r9=$row [10];
		$r10=$row [11];
		$r11=$row [12];
		
		

     include('connect.php');


$date = $_POST['date'];
$lorry = $_POST['lorry'];
 
	  	//$value = "'". implode("','", $row)."'";
	  	$q = "INSERT INTO collection(dept,user_id,user_name,enroll_id,device_id,place,date,time) 
		VALUES('$date','$lorry','$r','$r1','$r2','$r3','$r4','$r5')";
	  	if ($this->query($q)) {
	  		$this->state_csv = true;
	  	}else{
	  		$this->state_csv = false;
	  		echo $this->error;
	  	}

	  } 

	
	  
	 


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
	
	
	
	$d1=0;
$d2=0;
$d3=0;
$d4=0;
$d5=0;
$d6=0;
$d7=0;
$d8=0;
$d9=0;
$d10=0;
$d11=0;
$d12=0;
$d13=0;
$d14=0;
$d15=0;
	

$result = $db->prepare("SELECT * FROM collection  ORDER by transaction_id ASC LIMIT 3,100000");
				
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
	$lorry=$row['lorry_no'];
	
	
	$result1 = $db->prepare("SELECT * FROM loading WHERE lorry_no='$lorry' AND action='load' ");
				
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
	             $root=$row1['root'];
				 $term=$row1['term'];
				$product_code=$row1['product_code'];
					$transaction_id=$row1['transaction_id'];
					
					 switch ($product_code) {
			    case "1":
				$qty= $d1;
				break;
				case "3":
				$qty=$d2;
				break;
				case "2":
				$qty=$d3;
				break;
				case "4":
				$qty=$d4;
				break;	
				case "5":
				$qty= $d5;
				break;
				case "7":
				$qty=$d6;
				break;
				case "6":
				$qty=$d7;
				break;
				case "8":
				$qty=$d8;
				break;
				}
					
					
					
//################# UPDATE loading #######################				
					
	$sql = "UPDATE loading 
        SET qty=qty-? 
		WHERE transaction_id=?
		";
$q = $db->prepare($sql);
$q->execute(array($qty,$transaction_id));
					
					
					
					
				}
					
					
$result1 = $db->prepare("SELECT * FROM root WHERE root_name='$root'  ");
				
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
	             $area=$row1['root_area'];
				 
				}
					
	
	
	$sql = "INSERT INTO sales_order (invoice,customer,12_5kg_gas,37_5kg_gas,5kg_gas,2kg_gas,12_5kg_cylinders,37_5kg_cylinders,5kg_cylinders,2kg_cylinders,date,lorry_no,root,term,area) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invoice,':b'=>$customer,':c'=>$d1,':d'=>$d2,':e'=>$d3,':f'=>$d4,':g'=>$d5,':h'=>$d6,':i'=>$d7,':j'=>$d8,':k'=>$date,':l'=>$lorry,':m'=>$root,':n'=>$term,':o'=>$area));

				
				}				

$a="";
		$result = $db->prepare("DELETE FROM sales_order WHERE  customer= :memid");
	$result->bindParam(':memid', $a);
	$result->execute();
			

		$result = $db->prepare("DELETE FROM collection ");
	$result->bindParam(':memid', $a);
	$result->execute();
			 
				
}

}


?>