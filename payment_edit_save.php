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



$result = $db->prepare("SELECT * FROM payment WHERE transaction_id='$id'  ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $chq_no_o=$row['chq_no'];
    $chq_date_o=$row['chq_date'];
    $bank_o=$row['bank'];
    $sales_id=$row['sales_id'];
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
