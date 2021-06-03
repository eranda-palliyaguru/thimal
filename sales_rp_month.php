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

if($r =='Cashier'){

header("location:./../../../index.php");
}
if($r =='admin'){

include_once("sidebar.php");
}
if($r =='user'){

include_once("sidebar2.php");
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




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Credit Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

   <br>


      <form  method="get">
	<center>



			<strong>

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" />
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

       <div class="col-md-6">
              <div class="form-group">
                <label>customer</label>
                <select class="form-control select2" name="fil" style="width: 350px;" autofocus >
                <option value="all"> All Customer </option>
                 <option value="1"> Channel </option>
					<option value="2">  Commercial</option>
          <option value="3">Apartment</option>

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
              <h3 class="box-title">Credit Report  <a href="sales_rp_month_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
	       <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th colspan="4" ></th>
				   <th colspan="2" >12.5kg</th>
				   <th colspan="2" >5kg</th>
				    <th colspan="2" >37.5kg</th>
					<th colspan="2" >2kg</th>
				    <th colspan="5" >#</th>
                </tr>

				<tr>
				<th>Cus_id</th>
				<th>Customer</th>
				<th>Invoice</th>
				<th>Date</th>

				   <th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>

				<th>18L</th>
				<th>Amount</th>
				<th>Due</th>
				<th>Phone no</th>
				<th>#</th>
				</tr>
				</thead>

                <tbody>
				<?php  $e12=0; $e5=0; $e2=0; $e32=0;   $g12=0; $g5=0; $g2=0; $g32=0;
					$tot=0;
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$pay_type="";

				//$d3=$_SESSION['SESS_FIRST_NAME'];
				$d1=$_GET['d1'];
			    $d2=$_GET['d2'];
				$fil=$_GET['fil'];


	if($fil=="all"){$result2z = $db->prepare("SELECT customer_id,customer_name FROM customer ");}else{
	$result2z = $db->prepare("SELECT customer_id,customer_name FROM customer WHERE type='$fil'");}

				$result2z->bindParam(':userid', $d2);
                $result2z->execute();
                for($i=0; $row = $result2z->fetch(); $i++){
				$customer_id=$row['customer_id'];

					?>
                <tr>
				<td><?php echo $row['customer_id'];?></td>
				<td><?php echo $row['customer_name'];?></td>
				<td></td>
				<td></td>


 <?php
				  $ter=4;

				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>



				<td><span class="pull-right badge bg-muted"><?php

			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id_e' and action='0' and cus_id='$customer_id' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){
		 echo $row1['sum(qty)'];

     if ($pro_id_e=='5') { $e12+=$row1['sum(qty)']; }
     if ($pro_id_e=='6') { $e5+=$row1['sum(qty)']; }
     if ($pro_id_e=='7') { $e32+=$row1['sum(qty)']; }
     if ($pro_id_e=='8') { $e2+=$row1['sum(qty)']; }
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php

			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' and cus_id='$customer_id' ");

					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){
		 echo $row1['sum(qty)'];

     if ($pro_id=='1') { $g12+=$row1['sum(qty)']; }
     if ($pro_id=='2') { $g5+=$row1['sum(qty)']; }
     if ($pro_id=='3') { $g32+=$row1['sum(qty)']; }
     if ($pro_id=='4') { $g2+=$row1['sum(qty)']; }
				}
			?></span></td>
					<?php } ?>
<?php
				  $ter1=7;
			$tot+=0;


			?>


		<td><span class="pull-right badge bg-yellow"><?php 		$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='24' and action='0' and cus_id='$customer_id' ");

  					$result->bindParam(':userid', $d1);
                  $result->execute();
                  for($i=0; $row1 = $result->fetch(); $i++){
  		 echo $row1['sum(qty)']; }?></span></td>
		<td></td>
		<td></td>
		<td></td>
			<td></td>
				<?php
		}



			?>
				</tr>

                </tbody>

                <tfoot   class=" bg-aqua"   >

				<td  colspan="3" >Total</td>

			<td></td>
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
	            $pro_id=$pro_id2+9;

			?>






					<?php } ?>

			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php echo $tot; ?></span></td>

	<td></td><td></td>
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
