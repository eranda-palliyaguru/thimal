<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue layout-top-nav">
<?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){

include_once("sidebar2.php");
}
if($r =='admin'){

//include_once("sidebar.php");
}
$_SESSION['page']="START";
?>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>

$(document).ready(function(){
	setInterval(function(){
		$("#screen").load('lorry_gps_view.php')

	}, 5000);
});
</script>


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


	  <?php
	 $tid="";
	  $uid=$_SESSION['SESS_MEMBER_ID'];
        $result = $db->prepare("SELECT * FROM user WHERE id='$uid'   ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$emid=$row['EmployeeId'];
		}
	    $result = $db->prepare("SELECT * FROM loading WHERE driver='$emid' and action='load'   ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		 $tid=$row['transaction_id'];
		}

	  if($tid>0){
	  ?>



     <div class="row">
      <div id="screen"></div>

<div class="col-md-6">
              <div class="form-group">
                <label>Customer</label>
				<form method="get" action="sales.php">

                <select class="form-control select2" name="id"  style="width: 100%;" autofocus >

			<?php
                $result = $db->prepare("SELECT * FROM customer   ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_id']."__".$row['customer_name']; ?>    </option>
	<?php	}	?>



                </select>
				</div>

		<input class="btn btn-info" type="submit" value="Submit" >
				  </form>
              </div><br><br><br>
        <!-- /.col -->
	<div class="col-md-2"><a href="set_lorry_sum.php">
	<button type="button" class="btn btn-block btn-success btn-sm">#CASH SUM</button></a><br>
	<a href="set_lorry_expenses.php">
	<button type="button" class="btn btn-block btn-info btn-sm">#Expenses</button></a> <br>

	<a href="lorry_credit_view.php">
	<button type="button" class="btn btn-block btn-danger btn-sm">#Credit</button></a>
		 </div><br>

		 <section class="content">
<div class="box box-info">
		 <div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

				<th>Product </th>
				<th>Qty</th>

				</tr>
                </thead>
                <tbody>
				<?php
                include("connect.php");




				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$tid' and  product_code<'5' ORDER by transaction_id ASC");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>

				<tr>
                <td><?php echo $row['product_name'];?></td>
				 <td><span class="badge bg-green"><?php echo $row['qty']; ?></span>
				<span class="badge bg-"><?php echo $row['qty_sold']; ?></span>
					</td>



				<?php
				}
				   ?></td>
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>

			 <h2>Invoice</h2>
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


				//$id=$_GET['id'];



				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM payment WHERE  loading_id='$tid' and action>'0'  ORDER by transaction_id DESC");
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

					 $result1 = $db->prepare("SELECT * FROM collection WHERE  loading_id=$tid and action='0' ");
					 $result1->bindParam(':userid', $c);
					 $result1->execute();
					 for($i=0; $row = $result1->fetch(); $i++){

					 			?>

					 				<tr style="background-color:#7FB3D5">
					         <td><?php echo $row['invoice_no'];?></td>
					 				 <td><?php echo $row['customer'];?></td>
					 				 <td><?php echo $row['pay_type'];?></td>
					 				 <td><?php echo $row['amount'];?></td>
					 				 <td><?php echo $row['chq_no'];?></td>
					 				<td><?php echo $row['chq_date'];?></td>
					 				<td><?php echo $row['bank'];?></td>
					                 </tr>
					 								<?php
					 								}
					 									 ?>

                </tbody>
                <tfoot>
                </tfoot>
              </table>
        <!-- /.col -->
			 </div> </div></div></section>
    <!-- Main content -->
<?php	}else{	?>
	<div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Loading නොමැත කරුනා කර Load කර නැවත උත්සාහ කරන්න
              </div></div>


	  <?php	}	?>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php
 // include("dounbr.php");
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
    $(".select2").select2({ dropdownCssClass: "myFont" });


    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
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

<style>
	.myFont{
  font-size:30px;
}</style>


</body>
</html>
