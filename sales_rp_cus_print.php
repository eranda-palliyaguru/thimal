<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | All Sales</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->

	<style>
th
{
  vertical-align: bottom;
  text-align: center;
}

th span
{
  -ms-writing-mode: tb-rl;
  -webkit-writing-mode: vertical-rl;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  white-space: nowrap;
}
</style>

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

$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$cus=$_GET['cus'];
        $lorry=$_GET['lorry'];
        $product=$_GET['product'];
        $cus_type =$_GET['customer_type'];
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $cus;?>&lorry=<?php echo $lorry;?>&product=<?php echo $product;?>&customer_type=<?php echo $cus_type;?>'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Thimal Enterprises (Pvt.) Ltd

          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo");
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
		<h4>
		<?php echo "FROM- ".$_GET['d1']." TO- ".$_GET['d2']; ?>
		<h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <!-- /.row -->
<div class="box-body">

       <table id="example1" class="table table-bordered table-striped">
    <thead>

    <tr>



      <th colspan="3" > <h3>Lorry - <?php echo $_GET['lorry'];?></h3>  </th>
<th colspan="2" >12.5kg</th>
<th colspan="2" >5kg</th>
<th colspan="2" >37.5kg</th>

<th colspan="2" >2kg</th>
<?php
$qty=0;

$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");
$result1->bindParam(':userid', $d2);
    $result1->execute();
    for($i=0; $row = $result1->fetch(); $i++){
  $id=$row['product_id'];


?>
<th  style="" ><span> <?php echo $row['gen_name']; ?></span></th>
<?php } ?>

<th colspan="5" ></th>

    </tr>

<tr>
<th>Invoice</th>
<th>Date AND Lorry</th>
<th>Customer</th>
<th  >E</th>
<th  >R</th>
<th  >E</th>
<th  >R</th>
<th  >E</th>
<th  >R</th>
<th  >E</th>
<th  >R</th>
<?php
$qty=0;


$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");
$result1->bindParam(':userid', $d2);
    $result1->execute();
    for($i=0; $row = $result1->fetch(); $i++){
  $id=$row['product_id'];


?>
<th></th>

<?php } ?>
<th>Pay Type</th>
<th>Chq Date</th>
<th>Amount</th>
<th>Margin</th>
</tr>

    </thead>
    <tbody>
<?php
date_default_timezone_set("Asia/Colombo");
$hh=date("Y/m/d");
$tot=0;	$tot_f=0; $cash_pay=0; $chq_pay=0; $credit_pay=0; $cash_pay1=0; $chq_pay1=0; $credit_pay1=0;

$e12=''; $e5=''; $e32=''; $e2='';  $g12=''; $g5=''; $g32=''; $g2='';



$d1=$_GET['d1'];
$d2=$_GET['d2'];
$cus_id=$_GET['cus'];
$lorry =$_GET['lorry'];
$product =$_GET['product'];


if($product=='all'){ $pro1='0'; $pro2='50'; }
if($product=='1'){$pro1='0'; $pro2='5'; }
if($product=='2'){$pro1='4'; $pro2='9'; }
if($product=='3'){$pro1='9'; $pro2='50'; }


if ($cus_id=="all") {$result_customer = $db->prepare("SELECT * FROM customer  ");}else {
  $result_customer = $db->prepare("SELECT * FROM customer WHERE  customer_id='$cus_id'  ");}
              $result_customer->bindParam(':userid', $d1);
                    $result_customer->execute();
                    for($i=0; $row_customer = $result_customer->fetch(); $i++){
         $customer_id_t = $row_customer['customer_id'];
$cus_t=0;
$e12cus=''; $e5cus=''; $e32cus=''; $e2cus='';  $g12cus=''; $g5cus=''; $g32cus=''; $g2cus='';


if($lorry=="all"){ $result2 = $db->prepare("SELECT * FROM sales WHERE  customer_id='$customer_id_t' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
}else{ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and lorry_no='$lorry' and customer_id='$customer_id_t' AND date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
}
$cus="=".$cus_id;




$result2->bindParam(':userid', $d2);
$result2->execute();
for($i=0; $row2 = $result2->fetch(); $i++){
$invo=$row2['invoice_number'];
  $customer_id=$row2['customer_id'];

$emty_miter=0;
$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id > '$pro1' AND product_id < '$pro2' and  action='0' ");

$result->bindParam(':userid', $d1);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
$emty_miter = $row['qty'];
}
$cus_t=0;
if ($cus_type=="all") {$result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$customer_id'  ");}else {
  $result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$customer_id' AND type='$cus_type'  ");}
              $result->bindParam(':userid', $d1);
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
         $cus_t = $row['customer_id'];
            }

if($emty_miter > 0){
if($cus_t > 0){

?>
    <tr>

<td><?php echo $row2['transaction_id'];?></td>
<td><?php echo $row2['date'];?>
<span class="pull-right badge bg-yellow"><?php echo $row2['lorry_no'];?> </span>
</td>
      <td><?php echo $row2['name'];?></td>

<?php
$ter=4;

for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
  $pro_id=$pro_id1+1;
$pro_id_e=$pro_id1+5;
?>



<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' ");

$result->bindParam(':userid', $d1);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];


if ($pro_id_e=='5') { $e12+=$row['qty'];$e12cus+=$row['qty']; }
if ($pro_id_e=='6') { $e5+=$row['qty'];$e5cus+=$row['qty']; }
if ($pro_id_e=='7') { $e32+=$row['qty']; $e32cus+=$row['qty']; }
if ($pro_id_e=='8') { $e2+=$row['qty'];$e2cus+=$row['qty']; }



}
?></span></td>
<td><span class="pull-right badge bg-yellow"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' ");

$result->bindParam(':userid', $d1);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];

if ($pro_id=='1') { $g12+=$row['qty'];$g12cus+=$row['qty']; }
if ($pro_id=='2') { $g5+=$row['qty']; $g5cus+=$row['qty'];}
if ($pro_id=='3') { $g32+=$row['qty']; $g32cus+=$row['qty']; }
if ($pro_id=='4') { $g2+=$row['qty']; $g2cus+=$row['qty']; }
}
?></span></td>
<?php } ?>
<?php
$ter1=7;

for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
  $pro_id=$pro_id2+10;

?>



<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' ");

$result->bindParam(':userid', $d1);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];
}
?></span></td>

<?php } ?>
<td></td><td></td>
<?php

$result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' ");

$result->bindParam(':userid', $d1);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
$type= $row['type'];
$ch_date=$row['chq_date'];
}

$result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' AND type = 'credit'  ");
$result->bindParam(':userid', $d1);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
$credit_pay1= $row['amount'];
}
$credit_pay+= $credit_pay1;

$result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' AND type = 'cash'  ");
  $result->bindParam(':userid', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
$cash_pay1=$row['amount'];
}
$cash_pay+=$cash_pay1;

$result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' AND type = 'chq'  ");
    $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
$chq_pay1= $row['amount'];
  }
  $chq_pay+= $chq_pay1;
?>

<td><?php echo $type;?></td>
<td><?php echo $ch_date;?></td>


<td><?php echo $row2['amount'];?></td>
<td><?php echo $row2['profit'];?></td>


<?php
$tot+=$row2['amount'];
$tot_f+=$row2['profit'];

} } }


?>
</tr>
<?php if($cus_t > 0){ ?>
<tr>
  <td  colspan="3" >Total</td>


  <?php $invo="2520011210105934";
  $ter=4;
  for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
    $pro_id=$pro_id1+1;
  $pro_id_e=$pro_id1+5;
  ?>
  <td><span class="pull-right badge bg-muted"><?php

  if ($pro_id_e=='5') { echo $e12cus; }
  if ($pro_id_e=='6') { echo $e5cus; }
  if ($pro_id_e=='7') { echo $e32cus; }
  if ($pro_id_e=='8') { echo $e2cus; }

  ?></span></td>
  <td><span class="pull-right badge bg-green"><?php

  if ($pro_id=='1') { echo $g12cus; }
  if ($pro_id=='2') { echo $g5cus; }
  if ($pro_id=='3') { echo $g32cus; }
  if ($pro_id=='4') { echo $g2cus; }


  ?></span></td>

<?php }  ?>
  <?php
  $ter1=7;

  for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
    $pro_id=$pro_id2+10;

  ?>



  <td><span class="pull-right badge bg-muted"><?php

  $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' and cus_id='$customer_id_t' ");
  $result->bindParam(':userid', $d1);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
  echo $row['sum(qty)'];
  }
  ?></span></td>


  <?php } ?>

  <td></td><td></td><td></td><td></td>
  <td><span class="pull-right badge bg-muted"><?php 	echo $tot_cus;	?></span></td>

  <td><span class="pull-right badge bg-muted"><?php echo $tot_f_cus;	?></span></td>

</tr>

<?php } } ?>
    </tbody>




  <tfoot   class=" bg-aqua"   >

<td  colspan="3" >Total</td>


<?php $invo="2520011210105934";
$ter=4;
for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
  $pro_id=$pro_id1+1;
$pro_id_e=$pro_id1+5;
?>
<td><span class="pull-right badge bg-muted"><?php

if ($pro_id_e=='5') { echo $e12; }
if ($pro_id_e=='6') { echo $e5; }
if ($pro_id_e=='7') { echo $e32; }
if ($pro_id_e=='8') { echo $e2; }

?></span></td>
<td><span class="pull-right badge bg-green"><?php

if ($pro_id=='1') { echo $g12; }
if ($pro_id=='2') { echo $g5; }
if ($pro_id=='3') { echo $g32; }
if ($pro_id=='4') { echo $g2; }


?></span></td>

<?php } ?>
<?php
$ter1=7;

for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
  $pro_id=$pro_id2+10;

?>



<td><span class="pull-right badge bg-muted"><?php

if($cus_id=="all"){
$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' ");
}else{
$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' and cus_id='$cus_id' ");

}

$result->bindParam(':userid', $d1);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
echo $row['sum(qty)'];
}
?></span></td>


<?php } ?>

<td></td><td></td><td></td><td></td>
<td><span class="pull-right badge bg-muted"><?php 	echo $tot;	?></span></td>

<td><span class="pull-right badge bg-muted"><?php echo $tot_f;	?></span></td>

  </tfoot>
  </table>
  <h2>Cash Rs.<?php echo $cash_pay; ?></h2>
  <h2>CHQ Rs.<?php echo $chq_pay; ?></h2>
  <h2>Credit Rs.<?php echo $credit_pay; ?></h2>

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
