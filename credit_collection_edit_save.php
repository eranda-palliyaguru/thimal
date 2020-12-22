<?php
session_start();
include('connect.php');
$date=date('Y-m-d');
$user_id=$_SESSION['SESS_MEMBER_ID'];
$user=$_SESSION['SESS_FIRST_NAME'];

$id =$_POST['id'];


$result = $db->prepare("SELECT * FROM collection WHERE id='$id'  ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $rowz = $result->fetch(); $i++){
    $invoice_no=$rowz['invoice_no'];
    $customer_id=$rowz['customer_id'];
    $amount=$rowz['amount'];
    $chq_no=$rowz['chq_no'];
    $chq_date=$rowz['chq_date'];
    $bank=$rowz['bank'];
    $type=$rowz['pay_type'];
    $pay_id=$rowz['pay_id'];
  }

if ($pay_id==0) {

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


$colle=$id;
$chq_no = $_POST['chq_no'];
$chq_date = $_POST['chq_date'];
$bank = $_POST['bank'];
$amount = $_POST['amount'];

$result = $db->prepare("SELECT * FROM collection WHERE id='$id'  ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $id=$row['pay_id'];
  }

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

    $sql = "UPDATE collection
            SET amount=?
        WHERE id=?";
    $q = $db->prepare($sql);
    $q->execute(array($amount,$colle));

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

  $sql = "UPDATE collection
          SET chq_no=?
      WHERE id=?";
  $q = $db->prepare($sql);
  $q->execute(array($chq_no,$colle));
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

  $sql = "UPDATE collection
          SET chq_date=?
      WHERE id=?";
  $q = $db->prepare($sql);
  $q->execute(array($chq_date,$colle));
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

  $sql = "UPDATE collection
          SET bank=?
      WHERE id=?";
  $q = $db->prepare($sql);
  $q->execute(array($bank,$colle));
}






header("location: credit_collection.php");


?>
