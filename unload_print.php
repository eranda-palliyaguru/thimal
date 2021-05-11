<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD arm | Unload</title>
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
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='loading_view.php'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>  THIMAL ENTERPISES (pvt)LTD.

          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo");
	                                                        echo date("Y-m-d__h:ia")  ?></small>
        </h2>
		<h4>
		Unloading Report
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

				<th>Product </th>
				<th>Load Qty</th>
                 <th>Unload Qty</th>


				</tr>




                </thead>
                <tbody>
				<?php
                include("connect.php");

				$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM loading WHERE  transaction_id=$id ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$driver=$row['driver'];
$lorry_no=$row['lorry_no'];
$he1=$row['helper1'];
$he2=$row['helper2'];
$date25=$row['date'];
}


				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$id'  ORDER by transaction_id DESC");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){



				$date=0;
				 $time=0;
				 $term=0;
				 $load_yard=0;
				 $unload_yard=0;


			?>

				<tr>
                <td><?php echo $row['product_name'];?></td>

				 <td><?php echo $row['qty'];?></td>
				  <td><?php echo $qty=$row['unload_qty'];?></td>


				<?php
				}
				   ?></td>
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
		<td> Date:
			<?php echo $date25; ?>
			</td>
			<br>

		<td> Loading ID:
			<?php echo $id; ?>
			</td>
			<br>



			  <td> Lorry NO:
			<?php echo $lorry_no; ?>
			</td>
			<br>

			<td> Driver:
			<?php
		$result = $db->prepare("SELECT * FROM employee WHERE  id='$driver'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['name'];
				}
				//echo $driver; ?>
			</td>
			<br>

			<td> Helper 1:
			<?php $result = $db->prepare("SELECT * FROM employee WHERE  id='$he1'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['name'];
				} ?>
			</td>
			<br>


			<td> Helper 2:
			<?php $result = $db->prepare("SELECT * FROM employee WHERE  id='$he2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['name'];
				} ?>
			</td>
			<br>


            </div>
    <!-- Table row -->

    <!-- /.row -->














 <!------------------------------------------------------------- /.Sales view------------------------------------------------------------------------------ -->

		  <div class="box-header with-border">
          <h3 class="box-title">Lorry Sales Report<span class="pull-right badge bg-muted">Empty</span><span class="pull-right badge bg-yellow">Refill</span></h3>


		   <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>



                  <th colspan="2" ></th>
				   <th colspan="2" >12.5kg</th>
				   <th colspan="2" >5kg</th>
				    <th colspan="2" >37.5kg</th>

					<th colspan="2" >2kg</th>
				   <?php
				  $qty=0;

				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id DESC");
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];


			?>
				   <th></th>
				   <?php } ?>

                </tr>
				<tr>
				<th>Invoice</th>
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


				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id DESC");
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];


			?>
				   <th><?php echo $row['gen_name']; ?></th>
				   <?php } ?>

				<tr>

                </thead>
                <tbody>
				<?php
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");

				$id=$_GET['id'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result2 = $db->prepare("SELECT * FROM sales WHERE loading_id='$id' and action='1'  ORDER by transaction_id DESC");

					$result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['invoice_number'];





			?>
                <tr>

				<td>
          <?php
          $cus_cus=$row2['customer_id'];
          $cus_id_1=0;
          $result12 = $db->prepare("SELECT * FROM special_price WHERE customer_id='$cus_cus'  ");
          $result12->bindParam(':userid', $date);
                $result12->execute();
                for($i=0; $row12 = $result12->fetch(); $i++){
          $cus_id_1=$row12['customer_id']; }
          if($cus_id_1 >'0'){?><span style="font-size: 12px;" class="label label-danger">special</span><?php } ?>


          <?php echo $row2['transaction_id'];?></td>
                  <td><?php echo $row2['name'];?></td>

 <?php
				  $ter=4;

				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['qty'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['qty'];
				}
			?></span></td>
					<?php } ?>
<?php
$result = $db->prepare("SELECT count(product_id) FROM products WHERE product_id >'9' ");

    $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
$ter1= $row['count(product_id)'];
  }

  $result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id DESC");
  $result1->bindParam(':userid', $d2);
          $result1->execute();
          for($i=0; $row = $result1->fetch(); $i++){
        $pro_id=$row['product_id'];

			?>



				<td><span class="pull-right badge bg-muted"><?php

$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['qty'];
				}
			?></span></td>

					<?php } ?>




				<?php

				}


			?>
				</tr>

                </tbody>

                <tfoot   class=" bg-aqua"   >

				<td  colspan="2" >Total</td>


 <?php $invo="2520011210105934";
				  $ter=4;
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>
				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id_e' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['sum(qty)'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-green"><?php

			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['sum(qty)'];
				}
			?></span></td>
					<?php } ?>
<?php
$result = $db->prepare("SELECT count(product_id) FROM products WHERE product_id >'9' ");

    $result->bindParam(':userid', $d1);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
$ter1= $row['count(product_id)'];
  }
  $result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id DESC");
  $result1->bindParam(':userid', $d2);
          $result1->execute();
          for($i=0; $row = $result1->fetch(); $i++){
        $pro_id=$row['product_id'];


			?>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id' and action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['sum(qty)'];
				}
			?></span></td>

					<?php } ?>

                </tfoot>
              </table>



			               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

				<th>Invoice no </th>
				<th>Customer</th>
                 <th>Pay type</th>

				 <th>Amount </th>
                <th>Chq no</th>

				<th>Chq Date</th>
				<th>Bank</th>
				</tr>




                </thead>
                <tbody>
				<?php


				$id=$_GET['id'];



				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM payment WHERE  loading_id='$id' and action>'0'  ORDER by transaction_id DESC");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$invo=$row['invoice_no'];

$result1 = $db->prepare("SELECT * FROM sales WHERE  invoice_number=$invo and action='1' ");
$result1->bindParam(':userid', $c);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){

$in=$row1['transaction_id'];
$cus=$row1['name'];

}


			?>

				<tr>
                <td><?php echo $in;?></td>

				 <td><?php echo $cus;?></td>
				  <td><?php echo $row['type'];?></td>
				 <td><?php echo $row['amount'];?></td>
				 <td><?php echo $row['chq_no'];?></td>
				<td><?php echo $row['chq_date'];?></td>
				<td><?php echo $row['bank'];?></td>
</tr>
				<?php
				}
        //------------ Credit payment--------//

                  $result1 = $db->prepare("SELECT * FROM collection WHERE  loading_id=$id and action='0' ");
                  $result1->bindParam(':userid', $c);
                  $result1->execute();
                  for($i=0; $row = $result1->fetch(); $i++){
                       ?>
                         <tr style="background-color:#7FB3D5">
                          <td><?php echo $row['invoice_no'];?>(credit)</td>
                          <td><?php echo $row['customer'];?></td>
                          <td><?php echo $row['pay_type'];?></td>
                          <td><?php echo $row['amount'];?></td>
                          <td><?php echo $row['chq_no'];?></td>
                         <td><?php echo $row['chq_date'];?></td>
                         <td><?php echo $row['bank'];?></td>
                          </tr>
                     <?php   }    ?>

                </tbody>
                <tfoot>
                </tfoot>
              </table>
	<?php

	$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='cash' and action >'0'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$cash=$row['sum(amount)'];

}

$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='chq' and action >'0'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$chq=$row['sum(amount)'];

}


$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='credit' and action >'0'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$credit=$row['sum(amount)'];

}

$result = $db->prepare("SELECT sum(amount) FROM collection WHERE  loading_id='$id' AND pay_type='cash' and action ='0'  ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$c_cash=$row['sum(amount)'];
}

$result = $db->prepare("SELECT sum(amount) FROM collection WHERE  loading_id='$id' AND pay_type='chq' and action ='0'  ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$c_chq=$row['sum(amount)'];
}
	?>

<h3>
Cash- Rs.<?php echo $cash+$c_cash; ?><br>
CHQ- Rs.<?php echo $chq+$c_chq; ?><br>
Credit- Rs.<?php echo $credit; ?><br>
</h3>

<div class="row">
<div class="col-md-5">
<h3>Remove bill</h3>
<table id="example1" class="table table-bordered table-striped" style="width:350px">
           <thead>
           <tr>
     <th>Invoice no</th>
   <th>Type</th>
   <th>Amount (Rs.)</th>

           </tr>
           </thead>
<tbody>

<?php $result = $db->prepare("SELECT * FROM payment WHERE loading_id='$id' and action='0'  ");
     $result->bindParam(':userid', $date);
           $result->execute();
           for($i=0; $row = $result->fetch(); $i++){
        ?>
 <tr>
          <td><?php echo $row['sales_id'];   ?> </td>
   <td><?php echo $row['type'];   ?> </td>
<td>Rs.<?php echo $row['amount'];   ?></td>

           </tr>
   <?php }   ?>

   </tbody>
         </table></div>

<div class="col-md-5">
	<h3>Expenses</h3>
	  <table id="example1" class="table table-bordered table-striped" style="width:450px">
                <thead>
                <tr>
					<th>ID</th>
				<th>Type</th>
				<th>Amount (Rs.)</th>
                  <th>Comment</th>






                </tr>
                </thead>
<tbody>

<?php $result = $db->prepare("SELECT * FROM expenses_records WHERE loading_id='$id' and action='0' and m_type < '4' ");

					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){





				echo '<tr class="record">';



					   ?>


               <td><?php echo $row['sn'];   ?> </td>

				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['comment'];   ?></td>






                </tr>


				<?php }   ?>
				</tbody>

              </table>
</div></div>



	 <table id="example1" class="table table-bordered table-striped" style="width:350px">
                <thead>
                <tr>
				<th><i class="fa fa-money"></i></th>
				<th>QTY</th>
				<th>Amount</th>
		<?php

	   $result = $db->prepare("SELECT * FROM loading WHERE transaction_id='$id'   ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		 $tid=$row['transaction_id'];
			$tto=0;
		?>

				</tr>
                </thead>
               <tbody>
				<tr>
                <td>5000</td>
				 <td><?php echo $row['r5000']; ?></td>
				<td><?php $tto+=$row['r5000']*5000; echo $row['r5000']*5000; ?></td>
                </tr>
				<tr>
                <td>2000</td>
				 <td><?php echo $row['r2000']; ?></td>
				<td><?php $tto+=$row['r2000']*2000; echo $row['r2000']*2000; ?></td>
                </tr>
				<tr>
                <td>1000</td>
				 <td><?php echo $row['r1000']; ?></td>
				<td><?php $tto+=$row['r1000']*1000; echo $row['r1000']*1000; ?></td>
                </tr>
				<tr>
                <td>500</td>
				 <td><?php echo $row['r500']; ?></td>
				<td><?php $tto+=$row['r500']*500; echo $row['r500']*500; ?></td>
                </tr>
				<tr>
                <td>100</td>
				 <td><?php echo $row['r100']; ?></td>
				<td><?php $tto+=$row['r100']*100; echo $row['r100']*100; ?></td>
                </tr>
				<tr>
                <td>50</td>
				 <td><?php echo $row['r50']; ?></td>
				<td><?php $tto+=$row['r50']*50; echo $row['r50']*50; ?></td>
                </tr>
				<tr>
                <td>20</td>
				 <td><?php echo $row['r20']; ?></td>
				<td><?php $tto+=$row['r20']*20; echo $row['r20']*20; ?></td>
                </tr>
				<tr>
                <td>10</td>
				 <td><?php echo $row['r10']; ?></td>
				<td><?php $tto+=$row['r10']*10; echo $row['r10']*10; ?></td>
                </tr>
				<tr>
                <td><i class="fa fa-database"></i> Coine (කාසි)</td>
				 <td><?php echo $row['coins']; ?></td>
				<td><?php $tto+=$row['coins']; echo $row['coins']; ?></td>
                </tr>


					<tr>
                <td>Total</td>
				 <td><?php echo  $tto; ?></td>
                </tr>
				<tr>
                <td>Balance</td>
				 <td><?php echo  $row['cash_total']; ?></td>
                </tr>
					<?php } ?>
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
