<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$sales_qty=0;
$cus='3';
$invo="LAUGFS Gas PLC";

//$sql = "UPDATE bank 
//        SET type=?
//		WHERE receive=?";
//$q = $db->prepare($sql);
//$q->execute(array($cus,$invo));

$d1="2020-06-15";
$d2="2020-07-31";


$result = $db->prepare("SELECT * FROM loading WHERE  date BETWEEN '$d1' and '$d2' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
$id=$row['transaction_id'];


	
$result1 = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$id'  ORDER by transaction_id ASC");			
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
	 $load_qty=$row1['qty'];
	 $unload_qty=$row1['unload_qty'];
	 $pro_id_e=$row1['product_code'];
     $name=$row1['product_name'];

$result2 = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id_e' and action='0' ");
				
				$result2->bindParam(':userid', $d1);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){	
		 $sales_qty= $row2['sum(qty)'];
				}

				
$sum=$load_qty-$unload_qty;
	
	if($sum == $sales_qty){}else{
		$sum1=$sum-$sales_qty;
		echo $id."(".$name."__".$sum1.")<br>";
		
	}
				}

}

?>