<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
$user_lewal=$_SESSION['USER_LEWAL'];
if($r =='Cashier'){

include_once("sidebar2.php");
}
if($r =='admin'){

include_once("sidebar.php");
}
?>




<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>





    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Loading Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Report</li>
      </ol>
    </section>




      <!-- SELECT2 EXAMPLE -->


     <form action="loading_view.php" method="get">
	<center>



			<strong>

Loading id :<input type="text" style="width:223px; padding:4px;" name="id" />

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>

</strong>


			 </center>
			 </form>



    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Loarding Report</h3>





            <!-- /.box-header -->
            <div class="box-body">
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

				<th>Product </th>
				<th>Load Qty</th>
                 <th>Available Qty</th>


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
$unload=$row['action'];
}


				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$id'  ORDER by transaction_id ASC");
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
				  <td><?php echo $qty=$row['qty_sold'];?></td>


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

		 <div class="box-header with-border">
          <h3 class="box-title">Lorry Sales Report<span class="pull-right badge bg-muted">New</span><span class="pull-right badge bg-yellow">Refill</span></h3>


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

				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");
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
				   <th  >N</th>
				    <th  >R</th>
					<th  >N</th>
				    <th  >R</th>
					<th  >N</th>
				    <th  >R</th>
					<th  >N</th>
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
          if($cus_id_1 >'0'){?><span style="font-size: 12px" class="label label-danger">special</span><?php } ?>


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

                <tfoot   class=" bg-black"   >

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
	<td><span class="pull-right badge bg-yellow" ><?php

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
				<td><?php echo $row['bank'];?> </td>
        </tr>
				<?php
				}

        //------------ Credit payment--------//
                  $result1 = $db->prepare("SELECT * FROM collection WHERE  loading_id=$id ");
                  $result1->bindParam(':userid', $c);
                  $result1->execute();
                  for($i=0; $row = $result1->fetch(); $i++){
                    $action=$row['action'];
                    if ($action==0) {
                      $color_code='#7FB3D5';
                    }else {
                    $color_code='#E84141';
                    }
                       ?>
                         <tr style="background-color:<?php echo $color_code; ?>">
                          <td><?php echo $row['invoice_no'];?></td>
                          <td><?php echo $row['customer'];?></td>
                          <td><?php echo $row['pay_type'];?></td>
                          <td><?php echo $row['amount'];?></td>
                          <td><?php echo $row['chq_no'];?></td>
                         <td><?php echo $row['chq_date'];?></td>
                         <td><?php echo $row['bank'];
                       if ($user_lewal =='2') { if ($unload=='load') {
                         ?>
            <a href="credit_collection_dll.php?id=<?php echo $row['id']; ?>&lid=<?php echo $_GET['id']; ?>"> <span style="font-size: 12px" class="label label-danger">Remove</span> </a></td>
                <?php }} ?></tr>
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

<h3 style="color: green">Cash- Rs.<?php echo $cash+$c_cash; ?></h3>
<h3>CHQ- Rs.<?php echo $chq+$c_chq; ?></h3>
<h3 style="color: red">Credit- Rs.<?php echo $credit; ?></h3>


<div class="col-md-5">
<h3>Remove bill</h3>
<table id="example1" class="table table-bordered table-striped">
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
	  <table id="example1" class="table table-bordered table-striped">
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
					   ?>
			<tr>
               <td><?php echo $row['sn'];   ?> </td>
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['comment'];   ?></td>
                </tr>
				<?php }   ?>

<?php $result = $db->prepare("SELECT * FROM petty_topup WHERE loading_id='$id' and action='0'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					   ?>
			<tr style="background-color:cadetblue" >
               <td>Non </td>
				<td>Patty cash TOPUP</td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['date'];   ?></td>
                </tr>
				<?php }   ?>
				</tbody>
              </table></div>



		<div class="col-md-5">
		  <table id="example1" class="table table-bordered table-striped">
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
		$tto=0; ?>

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

                </tbody>
                <tfoot>
					<tr>
                <td>Total</td>
				 <td><?php echo  $tto; ?></td>
                </tr>
					<tr>
                <td>Balance</td>
				 <td><?php echo  $row['cash_total']; ?></td>
                </tr>
					<?php } ?>
                </tfoot>
              </table>
		  </div>


		 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>




    <!-- Main content -->

      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
    $('#datepickerd').datepicker({
      autoclose: true
    });





    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>




<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

</body>
</html>
