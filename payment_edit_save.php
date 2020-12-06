<?php
session_start();
include('connect.php');
$date=date('Y-m-d');
$user_id=$_SESSION['SESS_MEMBER_ID'];
$user=$_SESSION['SESS_FIRST_NAME'];

$id =$_POST['id'];
$chq_no = $_POST['chq_no'];
$chq_date = $_POST['chq_date'];
$bank = $_POST['bank'];
$amount = $_POST['amount'];



$result = $db->prepare("SELECT * FROM payment WHERE transaction_id='$id'  ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $chq_no_o=$row['chq_no'];
    $chq_date_o=$row['chq_date'];
    $bank_o=$row['bank'];
    $amount_o=$row['amount'];
    $sales_id=$row['sales_id'];
    $invoice_no=$row['invoice_no'];
      $customer_id=$row['customer_id'];
  }




  //-------- Amount ------------//
  if ($amount=="") {

  }else {

    $sql = "INSERT INTO payment_edit (tr_id,sales_id,user,user_id,date,colum,new,old) VALUES (?,?,?,?,?,?,?,?)";
  	$q = $db->prepare($sql);
  	$q->execute(array($id,$sales_id,$user,$user_id,$date,'amount',$amount,$amount_o));

    $sql = "UPDATE payment
            SET amount=?
    		WHERE transaction_id=?";
    $q = $db->prepare($sql);
    $q->execute(array($amount,$id));

    $result = $db->prepare("SELECT sum(amount) FROM payment WHERE sales_id='$sales_id' AND action > 0");
      $result->bindParam(':userid', $ttr);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
        $pay_total=$row['sum(amount)'];
      }

    $result = $db->prepare("SELECT * FROM sales WHERE transaction_id='$sales_id'");
        $result->bindParam(':userid', $ttr);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $bill_amount=$row['amount'];
        }

  //---- over ---------------///
  if ($bill_amount < $pay_total) {

    $over=$pay_total-$bill_amount;

    $sql = "INSERT INTO payment (invoice_no,amount,type,date,action,sales_id,customer_id) VALUES (?,?,?,?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($invoice_no,$over,"over",$date,"2",$sales_id,$customer_id));
  }
//------------- credit -------------//
if ($bill_amount > $pay_total) {

  $over=$bill_amount-$pay_total;

  $sql = "INSERT INTO payment (invoice_no,amount,type,date,action,sales_id,customer_id) VALUES (?,?,?,?,?,?,?)";
  $q = $db->prepare($sql);
  $q->execute(array($invoice_no,$over,"credit",$date,"2",$sales_id,$customer_id));

}

  }






//---------chq_no-----------//
if ($chq_no=="") {

}else {

  $sql = "INSERT INTO payment_edit (tr_id,sales_id,user,user_id,date,colum,new,old) VALUES (?,?,?,?,?,?,?,?)";
	$q = $db->prepare($sql);
	$q->execute(array($id,$sales_id,$user,$user_id,$date,'chq_no',$chq_no,$chq_no_o));


  $sql = "UPDATE payment
          SET chq_no=?
  		WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($chq_no,$id));
}

//----------- date ----------//
if ($chq_date=="") {

}else {

  $sql = "INSERT INTO payment_edit (tr_id,sales_id,user,user_id,date,colum,new,old) VALUES (?,?,?,?,?,?,?,?)";
	$q = $db->prepare($sql);
	$q->execute(array($id,$sales_id,$user,$user_id,$date,'chq_date',$chq_date,$chq_date_o));

  $sql = "UPDATE payment
          SET chq_date=?
  		WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($chq_date,$id));
}

//-------- Bank ------------//
if ($bank=="") {

}else {

  $sql = "INSERT INTO payment_edit (tr_id,sales_id,user,user_id,date,colum,new,old) VALUES (?,?,?,?,?,?,?,?)";
	$q = $db->prepare($sql);
	$q->execute(array($id,$sales_id,$user,$user_id,$date,'bank',$bank,$bank_o));

  $sql = "UPDATE payment
          SET bank=?
  		WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($bank,$id));
}






header("location: pay_sum.php");


?>
