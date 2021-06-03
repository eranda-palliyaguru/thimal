<?php
session_start();
include('../../../connect.php');
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");
$time = date("h:i:sa");

$id=$_POST['id'];
$pay_type=$_POST['type'];
$amount=$_POST['amount'];
//-----------------------------credit-------------------------------//
if ($pay_type=='credit') {
$payment_id=$_POST['invoice'];

$resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$payment_id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$invoice=$rowz['sales_id'];
}


$sql = "UPDATE return_bill
      SET set_off_invoice_no=?,set_off_pay_id=?
  WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invoice,$payment_id,$id));


$sql = "UPDATE payment
        SET pay_amount=pay_amount+?
    WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$payment_id));

$result = $db->prepare("SELECT * FROM payment  WHERE transaction_id='$payment_id'   ");
        $result->bindParam(':userid', $a);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
              $balance1=$row['pay_amount'];
              $am=$row['amount'];
              $loding_id=$row['loading_id'];
              $sales_id=$row['sales_id'];
              $cus_id=$row['customer_id'];
              $invo=$row['invoice_no'];
        }
        if($am <= $balance1){
        $ex="1";
        $sql = "UPDATE payment
                SET action=?
            WHERE transaction_id=?";
        $q = $db->prepare($sql);
        $q->execute(array($ex,$payment_id));


        $set_off=date('Y-m-d');
        $sql = "UPDATE payment
                SET set_off_date=?
            WHERE transaction_id=?";
        $q = $db->prepare($sql);
        $q->execute(array($set_off,$payment_id));
        }



        $sql = "INSERT INTO payment (invoice_no,pay_amount,amount,type,date,customer_id,credit_period,sales_id,action,loading_id,pay_credit) VALUES (:a,:b,:c,:d,:h,:cus,:crp,:sid,:act,:lod,:pyc)";
        $q = $db->prepare($sql);
        $q->execute(array(':a'=>$invo,':b'=>$amount,':c'=>$amount,':d'=>"bill_return",':h'=>$date,':cus'=>$cus_id,':crp'=>"",':sid'=>$sales_id,':act'=>"1",':lod'=>$loding_id,':pyc'=>"1"));


}
//-------------------------------cash----------------------------------//
if ($pay_type=='cash') {
$invo=$_POST['invo'];

  $sql = "UPDATE return_bill
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
}
//----------------------------chq------------------------------------//
if ($pay_type=='chq') {
$chq_no=$_POST['chq_no'];
$chq_date=$_POST['chq_date'];


  $sql = "UPDATE return_bill
        SET chq_no=?,chq_date=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($chq_no,$chq_date,$id));
}



$sql = "UPDATE return_bill
      SET pay_type=?,amount=?,action=?
  WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($pay_type,$amount,"1",$id));

$resultz = $db->prepare("SELECT * FROM return_bill_list WHERE return_id='$id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$product_id=$rowz['product_id'];
$qty=$rowz['qty'];

$sql = "UPDATE products
      SET qty=qty+?
  WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$product_id));
}

header("location: ../bill_return_rp.php?d1=$date&d2=$date");

 ?>
