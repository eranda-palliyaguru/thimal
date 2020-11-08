<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

//$a = $_POST['invoice'];



$result1 = $db->prepare("SELECT * FROM customer WHERE  type='0' ORDER by customer_id DESC limit 0,200 ");
$result1->bindParam(':userid', $lorry);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$customer_name = $row1['customer_name'];
$address = $row1['address'];
$contact = $row1['contact'];
$customer_id = $row1['customer_id'];

/// query
$sql = "INSERT INTO month (cus,addr,cus_id,phone) VALUES (:a,:b,:d,:p)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$customer_name,':b'=>$address,':d'=>$customer_id,':p'=>$contact));

$A1=0;$B1=0;	
//echo $customer_name;

for($month = 0; $month <32; $month++ ) {

if($month<11){$day="0".$month+1;}else{$day=$month+1;}	
	
$d1="2020-02-".$day;	
	
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date = '$d1'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '3'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$A=$rowz['sum(qty)'];
	
$col=$month+1 ."a";

$sql = "UPDATE month 
        SET $col=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($A,$customer_id));
	
$A1+=$A;	
}

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '1'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$B=$rowz['sum(qty)'];
	
	
$col=$month+1 ."b";

$sql = "UPDATE month 
        SET $col=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($B,$customer_id));

$B1+=$B;
	
}
	
}
	
}
$A1=0;$A2=0;$r38=0;$r2=0;$e12=0;$e5=0;$e38=0;$e2=0;
$A11=0;$A21=0;$r381=0;$r21=0;$e121=0;$e51=0;$e381=0;$e21=0;
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '1'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$A11=$rowz['sum(qty)'];
	
} 
$A1+=$A11;
}
	
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '2'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$A21=$rowz['sum(qty)'];
	
}
$A2+=$A21;
}

$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '3'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$r381=$rowz['sum(qty)'];
	
} 
$r38+=$r381;
}

$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '4'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$r21=$rowz['sum(qty)'];
	
}
$r2+=$r21;
}
	
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '5'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$e121=$rowz['sum(qty)'];
	
} 
$e12+=$e121;
}	
	
$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '6'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$e51=$rowz['sum(qty)'];
	
}
$e5+=$e51;
}

$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '7'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$e371=$rowz['sum(qty)'];
	
}
$e37+=$e371;
}

$result = $db->prepare("SELECT * FROM sales WHERE  customer_id= :userid and date BETWEEN '2020-02-01' and '2020-02-31'  ");
$result->bindParam(':userid', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$inva=$row['invoice_number'];

$resultz = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  invoice_no= :userid and product_id = '8'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$e21=$rowz['sum(qty)'];
	
} 
$e2+=$e21;
}
	
$sql = "UPDATE month 
        SET 12r=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($A1,$customer_id));
	
$sql = "UPDATE month 
        SET 5r=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($A2,$customer_id));
	
$sql = "UPDATE month 
        SET 38r=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($r38,$customer_id));

$sql = "UPDATE month 
        SET 2r=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($r2,$customer_id));

$sql = "UPDATE month 
        SET 12e=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($e12,$customer_id));
	
$sql = "UPDATE month 
        SET 5e=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($e5,$customer_id));
	
$sql = "UPDATE month 
        SET 38e=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($e38,$customer_id));

$sql = "UPDATE month 
        SET 2e=?
		WHERE cus_id=?";
$q = $db->prepare($sql);
$q->execute(array($e2,$customer_id));

}

//header("location: purchase dis2.php?invoice=$a&date=$date&yard=$yard");


?>