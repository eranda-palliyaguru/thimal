<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){

header("location:./../../../index.php");
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
 <script type="text/javascript">

		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });

    });

    </script>


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

    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

 <section class="content">
    <div class="box box-info">

          <div class="box-body">



     <form  method="get">
<div class="row">
       <div class="col-md-6">
         <div class="form-group">

<label>Date</label>



           From :<input type="text" style="width:123px; padding:4px;" name="d1" id="datepicker" value="<?php echo $_GET['d1']; ?>" autocomplete="off" />
           To:<input type="text" style="width:123px; padding:4px;" name="d2" id="datepickerd"  value="<?php echo $_GET['d2']; ?>" autocomplete="off"/>






             </div>
   </div>

   <div class="col-md-6">
     <div class="form-group">
       <div class="input-group">
       <div class="input-group-addon">
       <label>customer</label>
       </div>
       <select class="form-control select2" name="cus" style="width: 350px;" autofocus >
       <option value="all"> All Customer </option>

 <?php
       $result = $db->prepare("SELECT * FROM customer ORDER by customer_id ASC ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_id']."_".$row['customer_name']; ?>    </option>
<?php
}
?>
       </select>
</div>
</div></div>


 </div>


<div class="row">



<div class="col-md-3">
                     <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon">
                       <label>Lorry</label>
                       	</div>
                       <select class="form-control select2" name="lorry"  autofocus >
                       <option value="all"> All Lorry </option>

       				  <?php
                       $result = $db->prepare("SELECT * FROM lorry ORDER by lorry_id ASC ");
       		$result->bindParam(':userid', $res);
       		$result->execute();
       		for($i=0; $row = $result->fetch(); $i++){
       	?>
       		<option ><?php echo $row['lorry_no']; ?>    </option>
       	<?php
       				}
       			?>
                       </select>
       				</div>	</div>	</div>

<div class="col-md-3">
              <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon">
                <label>products</label>
                </div>
                <select class="form-control select2" name="product"  autofocus >
                <option value="all"> All Customer </option>
                <option value="1"> Gas </option>
                <option value="2"> Cylinder </option>
                <option value="3"> Accessory </option>

                </select>
        </div></div></div>


<div class="col-md-3">
  <div class="form-group">
<div class="input-group">
<div class="input-group-addon">
    <b>Customer Type</b>
      </div>
      <select class="form-control select2" name="customer_type"  >
          <option value="all">All Customer</option>
          <option value="1">Channel</option>
          <option value="2">commercial</option>
          <option value="3">Apartment</option>
          </select>
      </div>
      </div></div>


    </div>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>



		<br>


			 </form>

     </div>
     <!-- /.box-body -->
   </div>



     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales Report
				<a href="sales_rp_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>&cus=<?php echo $_GET['cus'] ?>&lorry=<?php echo $_GET['lorry'] ?>&product=<?php echo $_GET['product'] ?>&customer_type=<?php echo $_GET['customer_type'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a>
				</h3>
            </div>
            <!-- /.box-header -->

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
        $cus_type =$_GET['customer_type'];


if($product=='all'){ $pro1='0'; $pro2='50'; }
if($product=='1'){$pro1='0'; $pro2='5'; }
if($product=='2'){$pro1='4'; $pro2='9'; }
if($product=='3'){$pro1='9'; $pro2='50'; }


if($cus_id=="all"){

  if($lorry=="all"){ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }else{ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and lorry_no='$lorry' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }



	$cus=">0";

}else{
  if($lorry=="all"){ $result2 = $db->prepare("SELECT * FROM sales WHERE  customer_id='$cus_id' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }else{ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and lorry_no='$lorry' and customer_id='$cus_id' AND date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
  }
  $cus="=".$cus_id;
}



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
  $result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$customer_id' AND type='$cus_type'  ");
}
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
<span class="pull-right badge bg-green"><?php echo $row2['lorry_no'];?> </span>
        </td>
                  <td><?php echo $row2['name'];?></td>

 <?php
				  $ter=4;

				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' AND action='0' ");

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

			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");

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
				  $ter1=9;

				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+10;

			?>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['qty'];
				}
			?></span></td>

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
        $credit_pay1= $row['sum(amount)'];
        }
        $credit_pay+= $credit_pay1;

        $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'cash' AND action > '0'  ");
          $result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
        $cash_pay1=$row['sum(amount)'];
        }
        $cash_pay+=$cash_pay1;

        $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'chq' AND action > '0'  ");
            $result->bindParam(':userid', $d1);
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
        $chq_pay1= $row['sum(amount)'];
          }
          $chq_pay+= $chq_pay1;
			?>

		<td><?php echo $type;?></td>
		<td><?php echo $ch_date;?></td>


		<td><?php echo $row2['amount'];?></td>
		<td><?php echo $row2['profit'];?>
			<a href="bill2.php?id=<?php echo $row2['invoice_number'];?>"   title="Click to pay" >
				  <button class="btn btn-primary">View</button></a></td>


				<?php
$tot+=$row2['amount'];
$tot_f+=$row2['profit'];

} } }


			?>
				</tr>

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
				  $ter1=9;

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

			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php 	echo $tot;	?></span></td>

	<td><span class="pull-right badge bg-muted"><?php echo $tot_f;	?></span></td>

              </tfoot>
              </table>
              <h2>Cash Rs.<?php echo $cash_pay; ?></h2>
              <h2>CHQ Rs.<?php echo $chq_pay; ?></h2>
              <h2>Credit Rs.<?php echo $credit_pay; ?></h2>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->





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
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
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

   $(".select2").select2();

  });


	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });

</script>
</body>
</html>
