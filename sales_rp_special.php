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

<?php
$hs=0;
$sql = "UPDATE customer
        SET s_price=?";
$q = $db->prepare($sql);
$q->execute(array($hs));




$result1 = $db->prepare("SELECT * FROM special_price WHERE product_id='3' AND price < '5945' ");
	$result1->bindParam(':userid', $d2);
    $result1->execute();
    for($i=0; $row = $result1->fetch(); $i++){
	$id=$row['customer_id'];
$hs=1;
$sql = "UPDATE customer
        SET s_price=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($hs,$id));

	}
	?>

 
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Special Price Report

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>




     <form  method="get">
	<center>



			<strong>

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" />
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

       <div class="col-md-6">
              <div class="form-group">
                <label>customer</label>
                <select class="form-control select2" name="cus" style="width: 350px;" autofocus >
                <option value="all"> All Customer </option>

				  <?php
                $result = $db->prepare("SELECT * FROM customer WHERE s_price='1' ORDER by customer_id ASC ");
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
              </div>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>

</strong>

		<br>

         <h4> Report from&nbsp;<i class=" text-primary "><?php echo $_GET['d1'] ?></i>&nbsp;to&nbsp;<i class=" text-primary "><?php echo $_GET['d2'] ?> </i>  </h4>

			 </center>
			 </form>



   <section class="content">

     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Special Price Report
				<a href="sales_rp_special_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>&cus=<?php echo $_GET['cus'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a>
				</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
            		   <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
				<th>Customer id</th>
				<th>Invoice</th>
				<th>Date</th>
				<th>Customer</th>
				   <th  >37.5 gas</th>
				    <th>SP Price</th>
				<th>Fix Price</th>
				<th>Different</th>
				<th>Reim Amount</th>
				<th>#</th>
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
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];

$view = $db->prepare("SELECT * FROM customer WHERE  s_price='1' ORDER by customer_id ASC");
				$view->bindParam(':userid', $d2);
                $view->execute();
                for($i=0; $row5 = $view->fetch(); $i++){
	            $cccus=$row5['customer_id'];


if($cus_id=="all"){
	$result2 = $db->prepare("SELECT * FROM sales WHERE customer_id='$cccus' and  action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");

	$cus=">0";
}else{
	$result2 = $db->prepare("SELECT * FROM sales WHERE  customer_id='$cus_id' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
	$cus="=".$cus_id;
}



				$result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['invoice_number'];

$sid=0;
$view1 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' and price < '5945' ");
				$view1->bindParam(':userid', $d2);
                $view1->execute();
                for($i=0; $row51 = $view1->fetch(); $i++){
	            $sid=$row51['id'];
				}
			if($sid > 1){
			?>
                <tr>
				<td><?php echo $row2['customer_id'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
                  <td><?php echo $row2['name'];?></td>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		 echo $row['qty'];
			$qqty=$row['qty'];
			$price=$row['price'];
			$amount=$row['amount'];
				}
			?></span></td>

			<td><?php echo $price; ?></td>
      <td>5945.00</td>
<td><?php echo 5945-$price; ?></td>



		<td><?php
			$fre=$qqty*5945;
			echo $fre-$amount; ?></td>
		<td><a href="bill2.php?id=<?php echo $row2['invoice_number'];?>"   title="Click to pay" >
				  <button class="btn btn-primary">View</button></a></td>


				<?php
$tot_d+=$qqty;
$tot+=$fre-$amount;

				}
				}
				}
			?>
				</tr>

                </tbody>

              <tfoot   class=" bg-aqua"   >

				<td  colspan="4" >Total</td>



			<td><span class="pull-right badge bg-muted"><?php 	echo $tot_d;	?></span></td>
				  <td></td><td></td>
		<td></td>

	<td><span class="pull-right badge bg-muted"><?php echo $tot;	?></span></td>
	<td></td>
                </tfoot>
              </table>

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
