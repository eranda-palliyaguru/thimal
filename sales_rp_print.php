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
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp.php?filter=<?php echo $_GET['filter'];?>&d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $_GET['cus'];?>&lorry=<?php echo $lorry;?>&product=<?php echo $_GET['product'];?>&customer_type=<?php echo $_GET['customer_type'];?>'">
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
          $lorry =$_GET['lorry'];
          $product =$_GET['product'];
          $filter=$_GET['filter'];

      //		$cus_id=$_GET['cus'];
      //    $cus_type =$_GET['customer_type'];
      //    $cus_group =$_GET['group'];

  if($product=='all'){ $pro1='0'; $pro2='50'; }
  if($product=='1'){$pro1='0'; $pro2='5'; }
  if($product=='2'){$pro1='4'; $pro2='9'; }
  if($product=='3'){$pro1='9'; $pro2='50'; }



  //-------------------------------------------Customer Filter----------------------------------------//
  if ($filter=="type") {
  $cus_type =$_GET['customer_type'];
  $customer_result = $db->prepare("SELECT customer_id FROM customer WHERE  type='$cus_type'  ");
  }

  if ($filter=="cus") {
  $cus_id=$_GET['cus'];
  $customer_result = $db->prepare("SELECT customer_id FROM customer WHERE  customer_id='$cus_id'  ");
  }

  if ($filter=="group") {
  $cus_group=$_GET['group'];
  $customer_result = $db->prepare("SELECT customer_id FROM customer WHERE  category='$cus_group'  ");
  }

  if ($filter=="") {
  $customer_result = $db->prepare("SELECT customer_id FROM customer ");
  }

                $customer_result->bindParam(':userid', $d1);
                $customer_result->execute();
                for($i=0; $row_225 = $customer_result->fetch(); $i++){
                $cus_id = $row_225['customer_id'];


  //-------------------------------------------------------------------------------Lorry Filter------------------------------------------------------------------------------//
  if ($lorry=="all"){ $result2 = $db->prepare("SELECT transaction_id,customer_id,invoice_number,date,name,lorry_no,amount,profit FROM sales WHERE  action='1' and customer_id='$cus_id' AND date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }else{
  $result2 = $db->prepare("SELECT transaction_id,customer_id,invoice_number,date,name,lorry_no,amount,profit FROM sales WHERE  action='1' AND lorry_no='$lorry' and customer_id='$cus_id' AND date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }

  //-------------------- Sales Data-------------------//
          $result2->bindParam(':userid', $d2);
          $result2->execute();
          for($i=0; $row2 = $result2->fetch(); $i++){
          $invo=$row2['invoice_number'];
          $customer_id=$row2['customer_id'];

  //------------------------------------------------ Product Filter------------------------------------------------------//
  $emty_miter=0;
              $result321 = $db->prepare("SELECT qty FROM sales_list WHERE  invoice_no='$invo' and product_id > '$pro1' AND product_id < '$pro2' and  action='0' ");
              $result321->bindParam(':userid', $d1);
              $result321->execute();
              for($i=0; $row321 = $result321->fetch(); $i++){
              $emty_miter = $row321['qty'];
            }
  if($emty_miter > 0){
        ?>
          <tr>
          <td><?php echo $row2['transaction_id'];?></td>
          <td><?php echo $row2['date'];?><span class="pull-right badge bg-green"><?php echo $row2['lorry_no'];?> </span></td>
          <td><?php echo $row2['name'];?></td>
        <?php
          $ter=4;
          for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
          $pro_id=$pro_id1+1;
          $pro_id_e=$pro_id1+5;
        ?>

          <td><span class="pull-right badge bg-muted"><?php
          $result = $db->prepare("SELECT qty FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' AND action='0' ");
          $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          echo $row['qty'];

      if ($pro_id_e=='5') { $e12+=$row['qty']; }
      if ($pro_id_e=='6') { $e5+=$row['qty']; }
      if ($pro_id_e=='7') { $e32+=$row['qty']; }
      if ($pro_id_e=='8') { $e2+=$row['qty']; }
          }
        ?></span></td>

        <td><span class="pull-right badge bg-yellow"><?php
        $result = $db->prepare("SELECT qty FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");
        $result->bindParam(':userid', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        echo $row['qty'];

       if ($pro_id=='1') { $g12+=$row['qty']; }
       if ($pro_id=='2') { $g5+=$row['qty']; }
       if ($pro_id=='3') { $g32+=$row['qty']; }
       if ($pro_id=='4') { $g2+=$row['qty']; }
          }
        ?></span></td>
            <?php } ?>


  <?php
  $result111212 = $db->prepare("SELECT product_id FROM products WHERE product_id >'9' ");
  $result111212->bindParam(':userid', $d1);
  $result111212->execute();
  for($i=0; $row111212 = $result111212->fetch(); $i++){
  $pro_id= $row111212['product_id'];
        ?>



          <td><span class="pull-right badge bg-muted"><?php
          $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");
          $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          echo $row['qty'];
          }?></span></td>

            <?php } ?>

      <?php
        $result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' ");
        $result->bindParam(':userid', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $type= $row['type'];
        $ch_date=$row['chq_date'];
          }

          $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'credit' AND action > '0'  ");
          $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $credit_pay1= $row['sum(amount)'];  }

          $credit_pay+= $credit_pay1;

          $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'cash' AND action > '0'  ");
          $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $cash_pay1=$row['sum(amount)'];    }
          $cash_pay+=$cash_pay1;

          $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'chq' AND action > '0'  ");
          $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $chq_pay1= $row['sum(amount)'];  }
          $chq_pay+= $chq_pay1;
        ?>

      <td><?php echo $type;?></td>
      <td><?php echo $ch_date;?></td>
      <td><?php echo $row2['amount'];?></td>
      <td><?php echo $row2['profit'];?></td>
      </tr>

      <?php
  $tot+=$row2['amount'];
  $tot_f+=$row2['profit'];
  } } }
        ?>


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
      $result111212 = $db->prepare("SELECT * FROM products WHERE product_id >'9' ");
      $result111212->bindParam(':userid', $d1);
      $result111212->execute();
      for($i=0; $row111212 = $result111212->fetch(); $i++){
      $pro_id= $row111212['product_id'];
        ?>



      <td><span class="pull-right badge bg-muted"><?php
    if($filter=="cus"){
      $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' and cus_id='$cus_id'");
    }else{
      $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0'  ");
    }
        $result->bindParam(':userid', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        echo $row['sum(qty)'];
          }
        ?></span></td>
            <?php } ?>
      <td></td>
      <td></td>
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
