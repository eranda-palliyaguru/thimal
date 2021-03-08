<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cloud ARM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
include("connect.php");
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales_credit.php?type=<?php echo $_GET['type'] ?>&cus=<?php echo $_GET['cus'] ?>&lorry=<?php echo $_GET['lorry'] ?>&group=<?php echo $_GET['group'] ?>'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header ">
          <i class="fa fa-globe"></i> Thimal Enterprises (Pvt.) Ltd

          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo");
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
		<h4>

		<h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <!-- /.row -->
<div class="box-body">
  <table id="example2" class="table table-bordered table-striped">
          <thead>


 <tr>
 <th>Cus_id</th>
 <th>Customer</th>
 <th>Invoice</th>
 <th>Date</th>



 <th>Limit</th>
 <th class="text-success"> 0 > 30</th>
 <th>30 > 60</th>
 <th>60 > 90</th>
 <th>90 > </th>
 </tr>
 </thead>

          <tbody>
 <?php
   $tot=0;
date_default_timezone_set("Asia/Colombo");
$hh=date("Y-m-d");
$pay_type="";
$due30=0;$due60=0;$due90=0;$due100=0;
$due30tot=0;$due60tot=0;$due90tot=0;$due100tot=0; $b_tot=0;
 //$d3=$_SESSION['SESS_FIRST_NAME'];
 $type=$_GET['type'];
 $customer_id=$_GET['cus'];
  $group=$_GET['group'];
  $lorry=$_GET['lorry'];
  $customer_type=$_GET['customer_type'];

  if($customer_id=="all"){
  if($group=="all"){

  if ($customer_type=="all") {
  $customer = $db->prepare("SELECT * FROM customer  ");
  }else {
  $customer = $db->prepare("SELECT * FROM customer WHERE type='$customer_type' ");
  }

  }else {
  $customer = $db->prepare("SELECT * FROM customer WHERE category='$group' ");
  }
    		}else{
  	$customer = $db->prepare("SELECT * FROM customer WHERE customer_id='$customer_id' "); }

$customer->bindParam(':userid', $d2);
          $customer->execute();
          for($i=0; $row_cus = $customer->fetch(); $i++){
 $cus=$row_cus['customer_id'];
  $limit=$row_cus['credit_period'];


$b_tot=0;

$result2z = $db->prepare("SELECT * FROM payment WHERE action='2' and type='credit' and customer_id='$cus'");

 $result2z->bindParam(':userid', $d2);
          $result2z->execute();
          for($i=0; $row = $result2z->fetch(); $i++){
 $sales_id=$row['sales_id'];

if ($lorry=='all') {
$result2 = $db->prepare("SELECT * FROM sales WHERE action='1' AND transaction_id='$sales_id'");
}else {
$result2 = $db->prepare("SELECT * FROM sales WHERE action='1' AND transaction_id='$sales_id' AND lorry_no='$lorry' ");
}

   $result2->bindParam(':userid', $d2);
          $result2->execute();
          for($i=0; $row2 = $result2->fetch(); $i++){
 $invo=$row2['invoice_number'];

$pay_type=$row['type'];
$action=$row['action'];


 $date1=$row2['date'];
$date =  date("Y-m-d");
   $sday= strtotime( $date1);
            $nday= strtotime($date);
            $tdf= abs($nday-$sday);
            $nbday1= $tdf/86400;
            $rso= intval($nbday1);

if($type=='due'){ $leval=$rso-$limit;	}else { $leval=$rso; }
$coo=$limit;
$rs1=$rso-$limit;
$due=$rso;


if($leval >= 0){
$color="";$color1="";
if($rs1>=30){$color="#f0f296"; $color1="black";}
if($rs1>=60){$color="#701144"; $color1="white";}


   ?>
  <tr style="background-color: <?php echo $color; ?>; color: <?php echo $color1; ?>">
 <td ><?php echo $row['customer_id'];?></td>
 <td><?php echo $row2['name'];?></td>
 <td><?php echo $row2['transaction_id'];?></td>
 <td><?php echo $row2['date'];?></td>
<td><?php echo $row_cus['credit_period'];?></td>
<?php
   $ter1=7;
$tot+=$row['amount']-$row['pay_amount'];

$b_tot+=$row['amount']-$row['pay_amount'];
?>


<td><?php if ($due <= 30) {  echo number_format($row2['amount']-$row['pay_amount'],1);
  $due30+=$row['amount']-$row['pay_amount'];
$due30tot+=$row['amount']-$row['pay_amount']; } ?></td>

<td><?php if ($due > 30 && $due <= 60) {  echo number_format($row2['amount']-$row['pay_amount'],1);
  $due60+=$row['amount']-$row['pay_amount'];
$due60tot+=$row['amount']-$row['pay_amount']; } ?></td>

<td><?php if ($due > 60 && $due <= 90) {  echo number_format($row2['amount']-$row['pay_amount'],1);
$due90+=$row['amount']-$row['pay_amount'];
$due90tot+=$row['amount']-$row['pay_amount']; } ?></td>

<td><?php if ($due > 90) {  echo number_format($row2['amount']-$row['pay_amount'],1);
$due100+=$row['amount']-$row['pay_amount'];
$due100tot+=$row['amount']-$row['pay_amount']; } ?></td>
   </tr>
 <?php
} }
 }

if($b_tot > 1){
?>
      <tr   class=" bg-gray"   >
        <td><?php echo $cus;?></td>

 <td >Total (Rs.<?php echo number_format($due30+$due60+$due90+$due100,1); ?>/-)</td>
<td></td>
<td></td>
<td></td>

<td><?php echo number_format($due30,1); ?></td>
<td><?php echo number_format($due60,1); ?></td>
<td><?php echo number_format($due90,1); ?></td>
<td><?php echo number_format($due100,1); ?></td>
          </tr>


<?php $b_tot=0; $due30=0;$due60=0;$due90=0;$due100=0;}  } ?>



          </tbody>


<tr class=" bg-aqua" >


 <td  colspan="3" >Total- <?php echo number_format($tot,2); ?></td>
<td></td>
<td></td>
<td><?php echo number_format($due30tot,1) ; ?></td>
<td><?php echo number_format($due60tot,1); ?></td>
<td><?php echo number_format($due90tot,1); ?></td>
<td><?php echo number_format($due100tot,1); ?></td>
</tr>
      </tbody>
        </table>


		 </div>
        </div>

      <!-- /.col -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
