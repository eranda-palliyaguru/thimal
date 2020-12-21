<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$olld=0;
$date=date("Y-m-d");
$error_id="";
$id = $_GET['id'];





$resultz = $db->prepare("SELECT * FROM collection WHERE  id='$id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$invoice_no=$rowz['invoice_no'];
$customer_id=$rowz['customer_id'];
$amount=$rowz['amount'];
$chq_no=$rowz['chq_no'];
$chq_date=$rowz['chq_date'];
$bank=$rowz['bank'];
$type=$rowz['pay_type'];
$pay_id=$rowz['pay_id'];
}


if($pay_id == 0){


if ($type=="chq") {
 $action="2";
 $pay_amount=0;
 if ($chq_no=="" || $chq_date=="" || $bank=="") {
 $error_id=5;
 }
}
if ($type=="cash") {
  $action="1";
  $pay_amount=$amount;
}





  $sql = "INSERT INTO payment (collection_id,pay_amount,amount,type,date,chq_no,chq_date,bank,sales_id,customer_id,pay_credit,action) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
  $q = $db->prepare($sql);
  $q->execute(array($id,$pay_amount,$amount,$type,$date,$chq_no,$chq_date,$bank,$invoice_no,$customer_id,"1","0"));

  $result = $db->prepare("SELECT * FROM payment WHERE collection_id='$id' ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $pay_id=$row['transaction_id'];

  }

  $sql = "UPDATE collection
          SET pay_id=?
      WHERE id=?";
  $q = $db->prepare($sql);
  $q->execute(array($pay_id,$id));

  $sql = "UPDATE credit_payment
          SET pay_id=?
      WHERE collection_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($pay_id,$id));

}





header("location: bulk_payment.php?id=$pay_id");
?>
