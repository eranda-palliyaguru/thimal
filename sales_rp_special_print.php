<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR BIZNAZ | All Sales</title>
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

$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$cus=$_GET['cus'];
        $fix_12='1443';
        $fix_37="4866";
        $fix_5="575";

?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp_special.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $cus;?>'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> HTJT Holdings (PVT)LTD.

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
<th>Customer id</th>
<th>Invoice</th>
<th>Date</th>
<th>Customer</th>
<th>37.5</th>
<th>12.5</th>
<th>5</th>
<th>SP Price</th>
<th>Fix Price</th>
<th>Different</th>
<th>Reim Amount</th>
</tr>

</thead>
<tbody>
<?php
date_default_timezone_set("Asia/Colombo");
$hh=date("Y/m/d");
$tot=0;	$tot_d=0;
$d1=$_GET['d1'];
$d2=$_GET['d2'];
$cus_id=$_GET['cus'];

$qty5=0;$qty12=0;$qty37=0;
//$d3=$_SESSION['SESS_FIRST_NAME'];
//$d3=$_GET['d3'];
if($cus_id=="all"){
$view = $db->prepare("SELECT * FROM customer WHERE  s_price='1' ORDER by customer_id ASC");
$cus=">0";
}else{
$view = $db->prepare("SELECT * FROM customer WHERE  s_price='1' AND customer_id='$cus_id' ORDER by customer_id ASC");
$cus="=".$cus_id;
}
$view->bindParam(':userid', $d2);
$view->execute();
for($i=0; $row5 = $view->fetch(); $i++){
$cccus=$row5['customer_id'];


$result2 = $db->prepare("SELECT * FROM sales WHERE customer_id='$cccus' and  action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
$result2->bindParam(':userid', $d2);
$result2->execute();
for($i=0; $row2 = $result2->fetch(); $i++){
$invo=$row2['invoice_number'];

$sid=0;
$view1 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' and price < '$fix_37' ");
$view1->bindParam(':userid', $d2);
$view1->execute();
for($i=0; $row51 = $view1->fetch(); $i++){
$sid=$row51['id'];
$fix=$fix_37;
}

$view1 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='1' and price < '$fix_12' ");
$view1->bindParam(':userid', $d2);
       $view1->execute();
       for($i=0; $row51 = $view1->fetch(); $i++){
     $sid=$row51['id'];
     $fix=$fix_12;
}
$view1 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='2' and price < '$fix_5' ");
       $view1->bindParam(':userid', $d2);
               $view1->execute();
               for($i=0; $row51 = $view1->fetch(); $i++){
             $sid=$row51['id'];
             $fix=$fix_5;
       }
if($sid > 1){
?>
<tr>
<td><?php echo $row2['customer_id'];?></td>
<td><?php echo $row2['transaction_id'];?></td>
<td><?php echo $row2['date'];?></td>
 <td><?php echo $row2['name'];?></td>



<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' AND  price < '$fix_37' ");

$result->bindParam(':userid', $d1);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];
$qqty=$row['qty'];
$qty37+=$row['qty'];
$price=$row['price'];
$amount=$row['amount'];
}

?></span></td>
<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='1' AND price < '$fix_12'  ");

$result->bindParam(':userid', $d1);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];
$qqty=$row['qty'];
$qty12+=$row['qty'];
$price=$row['price'];
$amount=$row['amount'];
}

?></span></td>

<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='2' AND price < '$fix_5'  ");

$result->bindParam(':userid', $d1);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo $row['qty'];
$qqty=$row['qty'];
$qty5+=$row['qty'];
$price=$row['price'];
$amount=$row['amount'];
}

?></span></td>

<td><?php echo $price; ?></td>
<td><?php echo $fix; ?></td>
<td><?php echo $fix-$price; ?></td>



<td><?php
$fre=$qqty*$fix;
echo $fre-$amount; ?></td>



<?php
//$tot_12+=$qty12;
$tot+=$fre-$amount;

}
}
}
?>
</tr>

</tbody>

<tfoot   class=" bg-aqua"   >

<td  colspan="4" >Total</td>


<td><span class="pull-right badge bg-muted"><?php 	echo $qty37;	?></span></td>
<td><span class="pull-right badge bg-muted"><?php 	echo $qty12;	?></span></td>
<td><span class="pull-right badge bg-muted"><?php 	echo $qty5;	?></span></td>
<td></td>
<td></td>

<td><span class="pull-right badge bg-muted"><?php echo $tot;	?></span></td>
<td></td>
</tfoot>
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
