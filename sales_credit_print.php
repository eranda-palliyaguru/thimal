.<?php header("content-type: text/html; charset=UTF-8");  ?>
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
<body onLoad="self.print()">
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
        <h2 class="page-header" style="color:red">
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
  <table >
          <thead>


 <tr>
 <th>id</th>
 <th style="width:30%;">Customer</th>
 <th>Invoice</th>
 <th>Date</th>




 <th style="width:10%;">Credit</th>
 <th style="width:10%;">payment</th>
 <th>Limit</th>
 <th>Overdue</th>

 </tr>
 </thead>

          <tbody>
 <?php
   $tot=0;
date_default_timezone_set("Asia/Colombo");
$hh=date("Y/m/d");
$pay_type="";

 //$d3=$_SESSION['SESS_FIRST_NAME'];
 $type=$_GET['type'];
 $customer_id=$_GET['cus'];
  $group=$_GET['group'];
  $lorry=$_GET['lorry'];
  $customer_type=$_GET['customer_type'];

  if($customer_id=="all"){
  if($group=="all"){

  if ($customer_type=="all") {
  $customer = $db->prepare("SELECT * FROM customer  ORDER BY category DESC");
  }else {
  $customer = $db->prepare("SELECT * FROM customer WHERE type='$customer_type' ORDER BY category DESC");
  }

  }else {
  $customer = $db->prepare("SELECT * FROM customer WHERE category='$group' ORDER BY category DESC");
  }
    		}else{
  	$customer = $db->prepare("SELECT * FROM customer WHERE customer_id='$customer_id' ORDER BY category DESC "); }

$customer->bindParam(':userid', $d2);
$customer->execute();
for($i=0; $row_cus = $customer->fetch(); $i++){
 $cus=$row_cus['customer_id'];
  $limit=$row_cus['credit_period'];


$b_tot=0;
$pay_tot=0;

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
            $rs1= intval($nbday1);

if($type=='due'){ $leval=$rs1-$limit;	}else { $leval=$rs1; }
$coo=$limit;
$rs1=$rs1-$limit;



if($leval >= 0){
$color="";$color1="";
if($rs1>=30){$color="#f0f296"; $color1="black";}
if($rs1>=60){$color="#701144"; $color1="white";}


   ?>
  <tr style="background-color: <?php echo $color; ?>; color: <?php echo $color1; ?>">
 <td ><?php echo $row['customer_id'];?></td>
 <td><?php echo $cus_name=$row2['name'];?></td>
 <td><?php echo $row2['transaction_id'];?></td>
 <td><?php echo $row2['date'];?></td>


<?php
   $ter1=7;
$tot+=$row['amount']-$row['pay_amount'];
?>


<td><?php echo number_format($row['amount']-$row['pay_amount'],1);
$b_tot+=$row['amount']-$row['pay_amount']; ?></td>
<td><?php if($row['pay_amount']>'0'){	echo number_format($row['pay_amount'],1); $pay_tot+=$row['pay_amount']; } ?></td>
<td><?php echo $row_cus['credit_period'];?></td>
<td><?php	echo $rs1;	?></td>

   </tr>
 <?php
} }
 }

if($b_tot > 1){
?>
      <tr   class=" bg-gray"   >


 <td  colspan="4" ><hr><h4> <?php echo  $cus_name; ?>  ___ Total</h4></td>


<td><hr> <h4><?php echo number_format($b_tot,1); ?></h4> </td>
<td><hr><h4><?php echo number_format($pay_tot,1); ?></h4></td>

<td colspan="2"><hr><h4>.</h4></td>
          </tr>

          <tr >
            <td colspan="8">.<hr></td>
              </tr>
<?php } } ?>


<tr>
  <td  colspan="3" >Total</td>




 <td></td>
 <td> <h3><?php echo number_format($tot,1); ?></h3> </td>
 <td></td>

 <td></td><td></td><td></td>
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
