<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$resultz = $db->prepare("SELECT p.transaction_id,p.date,p.customer_id,c.customer_id,c.credit_period,p.credit_period FROM payment AS p INNER JOIN customer AS c ON p.customer_id=c.customer_id WHERE p.type='credit' AND p.date BETWEEN '2022-03-08' AND '2022-03-21' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $row = $resultz->fetch(); $i++){



echo $row['payment.credit_period']."<br>";
 



}

?>
