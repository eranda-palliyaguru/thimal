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
        $fix_37="5845";
        $fix_5="575";

?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp_special.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $cus;?>'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 >
          <i class="fa fa-globe"></i> <?php $result = $db->prepare("SELECT * FROM info");
           $result->bindParam(':userid', $date);
          				 $result->execute();
          				 for($i=0; $row = $result->fetch(); $i++){
          					 echo $row['name'];
          					} ?>


          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo");
	                                                        echo date("Y-m-d____h:ia")  ?></small>



        </h2>
		<h4>
		<?php echo "FROM- ".$_GET['d1']." TO- ".$_GET['d2']; ?>
    <img class="pull-right" style="width:90px" src="cloud.png" alt="">
  </h4><br>

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
<th  >37.5 gas</th>
<th  >12.5 gas</th>
<th  >5 gas</th>
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
$view = $db->prepare("SELECT customer_name,customer_id FROM customer  ORDER by customer_id ASC");
$cus=">0";
}else{
$view = $db->prepare("SELECT customer_name,customer_id FROM customer WHERE   customer_id='$cus_id' ORDER by customer_id ASC");
$cus="=".$cus_id;
}
$view->bindParam(':userid', $d2);
$view->execute();
for($i=0; $row5 = $view->fetch(); $i++){
$cus_id=$row5['customer_id'];


$view1 = $db->prepare("SELECT qty,price,price_id,product_id,amount,sales_id,date,invoice_no FROM sales_list WHERE action='0' AND  cus_id='$cus_id' AND product_id < '5'  AND date BETWEEN '$d1' AND '$d2' ");
$view1->bindParam(':userid', $d2);
$view1->execute();
for($i=0; $list = $view1->fetch(); $i++){
$qty=$list['qty'];
$price=$list['price'];
$price_id=$list['price_id'];
$product_id=$list['product_id'];
$amount=$list['amount'];
$fix_price=0;


$view12 = $db->prepare("SELECT d_price FROM price_update WHERE  id='$price_id'  ");
$view12->bindParam(':userid', $d2);
$view12->execute();
for($i=0; $up = $view12->fetch(); $i++){
$fix_price=$up['d_price'];
}

if($price < $fix_price){
?>
<tr>
<td><?php echo $cus_id;?></td>
<td><?php echo $list['sales_id'];?></td>
<td><?php echo $list['date'];?></td>
 <td><?php echo $row5['customer_name'];?></td>

<td><span class="pull-right badge bg-muted"><?php	if ($product_id==3) { echo $qty; $qty37+=$qty;  }	?></span></td>
<td><span class="pull-right badge bg-muted"><?php	if ($product_id==1) { echo $qty; $qty12+=$qty; }	?></span></td>
<td><span class="pull-right badge bg-muted"><?php	if ($product_id==2) { echo $qty; $qty5+=$qty; }	?></span></td>

<td><?php echo $price; ?></td>
<td><?php echo $fix_price; ?></td>
<td><?php echo $fix_price-$price; ?></td>



<td><?php
$fre=$qty*$fix_price;
echo $fre-$amount; ?></td>



<?php
$tot_d+=$qty;
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
<td></td>


<td><span class="pull-right badge bg-muted"><?php echo $tot;	?></span></td>

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
