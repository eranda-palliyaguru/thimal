<?php
			   

include('connect.php');

 date_default_timezone_set("Asia/Colombo");

                  $d1 =  date("Y/01/01");
				  $d2 =  date("Y/01/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m1 =  $row['sum(amount)'];
}




                  $d1 =  date("Y/02/01");
				  $d2 =  date("Y/02/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m2 =  $row['sum(amount)'];
}




$d1 =  date("Y/03/01");
				  $d2 =  date("Y/03/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m3 =  $row['sum(amount)'];
}




$d1 =  date("Y/04/01");
				  $d2 =  date("Y/04/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m4 =  $row['sum(amount)'];
}



$d1 =  date("Y/05/01");
				  $d2 =  date("Y/05/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m5 =  $row['sum(amount)'];
}



$d1 =  date("Y/06/01");
				  $d2 =  date("Y/06/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m6 =  $row['sum(amount)'];
}




$d1 =  date("Y/07/01");
				  $d2 =  date("Y/07/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m7=  $row['sum(amount)'];
}



$d1 =  date("Y/08/01");
				  $d2 =  date("Y/08/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m8 =  $row['sum(amount)'];
}



$d1 =  date("Y/09/01");
				  $d2 =  date("Y/09/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m9 =  $row['sum(amount)'];
}




$d1 =  date("Y/10/01");
				  $d2 =  date("Y/10/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m10 =  $row['sum(amount)'];
}




$d1 =  date("Y/11/01");
				  $d2 =  date("Y/11/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m11 =  $row['sum(amount)'];
}



$d1 =  date("Y/12/01");
				  $d2 =  date("Y/12/31");

$result = $db->prepare("SELECT sum(amount) FROM credit_sales_order WHERE s_date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m12 =  $row['sum(amount)'];
}



// ----------------------------sales---------------------------------------------------------->

              $d1 =  date("Y/01/01");
				  $d2 =  date("Y/01/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m1t =  $row['sum(amount)'];
}




                  $d1 =  date("Y/02/01");
				  $d2 =  date("Y/02/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m2t =  $row['sum(amount)'];
}




$d1 =  date("Y/03/01");
				  $d2 =  date("Y/03/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m3t =  $row['sum(amount)'];
}




$d1 =  date("Y/04/01");
				  $d2 =  date("Y/04/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m4t =  $row['sum(amount)'];
}



$d1 =  date("Y/05/01");
				  $d2 =  date("Y/05/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m5t =  $row['sum(amount)'];
}



$d1 =  date("Y/06/01");
				  $d2 =  date("Y/06/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m6t =  $row['sum(amount)'];
}




$d1 =  date("Y/07/01");
				  $d2 =  date("Y/07/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m7t=  $row['sum(amount)'];
}



$d1 =  date("Y/08/01");
				  $d2 =  date("Y/08/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m8t =  $row['sum(amount)'];
}



$d1 =  date("Y/09/01");
				  $d2 =  date("Y/09/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m9t =  $row['sum(amount)'];
}




$d1 =  date("Y/10/01");
				  $d2 =  date("Y/10/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m10t =  $row['sum(amount)'];
}




$d1 =  date("Y/11/01");
				  $d2 =  date("Y/11/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m11t =  $row['sum(amount)'];
}



$d1 =  date("Y/12/01");
				  $d2 =  date("Y/12/31");

$result = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN '$d1' AND '$d2'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$m12t =  $row['sum(amount)'];
}




?>