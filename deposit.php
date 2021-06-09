<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
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
   <script src='js/jquery-1.12.3.js'></script>
 <script src='js/jquery.dataTables.min.js'></script>


    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <center>
      <h1 class="text-red">BANK</h1> </center>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Payment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">

        <div class="box-header with-border">
          <h2>
           Deposit
            <small>Preview</small>
          </h2>

        <!-- /.box-header -->

		   <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#chq" data-toggle="tab">Cheque</a></li>
              <li><a href="#cash" data-toggle="tab">CASH</a></li>

            </ul>
            <div class="tab-content" >
              <div class="active tab-pane" id="chq">
                    <h3 class="box-title">Cheque</h3>
	<table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr>
					<th>ID</th>
					<th>Bill Date</th>
					<th>Chq Date</th>
					 <th>Chq No.</th>
				<th>Bank</th>
				<th>Amount (Rs.)</th>
                  <th>#</th>

                </tr>
                </thead>
<tbody>

<?php $date=date("Y-m-d");
	$result = $db->prepare("SELECT * FROM payment WHERE  bank_action='0' and type='chq' and action = '2'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
               $chq_date=$row['chq_date'];
					if($chq_date==""){$dtt=0;}
if($chq_date==""){$dtt=1;}else{
$first  = new DateTime( $date );
$second = new DateTime( $chq_date );
$diff = $first->diff( $second );
$dtt=$diff->format( '%r%a' );
}
					if($dtt<=0){

	?>			<tr class="record">
               <td><?php echo $row['transaction_id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['chq_date'];   ?> </td>
	<td><?php echo $row['chq_no'];   ?></td>
				<td><?php echo $row['bank'];   ?></td>
              <td>Rs.<?php echo $row['amount'];   ?></td>
<td><a href="deposit_save.php?id=<?php echo $row['transaction_id']; ?>&t=1" class="delbutton" title="Click to Deposit" >
				  <button class="btn btn-danger"><i class="icon-trash">Deposit</i></button></a>
</td>
                </tr>
				<?php }  } ?>
				</tbody>


              </table>



              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="cash">
               <h3 class="box-title">Cash</h3>
              	<table id="example4" class="table table-bordered table-striped" >
                <thead>
                <tr>
					<th>ID</th>
					<th>Date</th>
					<th>Lorry No. / Invoice No</th>
				<th>Amount (Rs.)</th>
                  <th>#</th>

                </tr>
                </thead>
<tbody>

<?php $date=date("Y-m-d");
	$result = $db->prepare("SELECT * FROM loading WHERE  bank_action='0' AND cash_total > '0' AND action='unload'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){


	?>			<tr class="record">
               <td><?php echo $row['transaction_id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['lorry_no'];   ?> </td>
              <td>Rs.<?php echo $row['cash_total'];   ?></td>
<td><a href="deposit_save.php?id=<?php echo $row['transaction_id']; ?>&t=2" class="delbutton" title="Click to Deposit" >
				  <button class="btn btn-danger"><i class="icon-trash">Deposit</i></button></a>
</td>
                </tr>
				<?php }
//---------------------------------- credit payment -----------------------------------//
         $date=date("Y-m-d");
        	$result = $db->prepare("SELECT * FROM payment WHERE  bank_action='0' and type='cash' AND pay_credit='1' AND loading_id > '1'");
        					$result->bindParam(':userid', $date);
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){


        	?>			<tr class="record">
                       <td><?php echo $row['transaction_id'];   ?> </td>
        	       <td><?php echo $row['date'];   ?> </td>
        				<td>invoice no- <?php echo $row['sales_id'];   ?> </td>

                      <td>Rs.<?php echo $row['amount'];   ?></td>
        <td><a href="deposit_save.php?id=<?php echo $row['transaction_id']; ?>&t=3" class="delbutton" title="Click to Deposit" >
        				  <button class="btn btn-danger"><i class="icon-trash">Deposit</i></button></a>
        </td>
                        </tr>
        				<?php } ?>

				</tbody>
              </table>
              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->



		  </div></div>

		</section>
          <!-- /.box -->

		 <section class="content">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Deposit List</h3>
            </div>
            <div class="box-body">

			 <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID</th>
				<th>Date</th>
				<th>Type</th>
				<th>Amount (Rs.)</th>
                <th>CHQ No / Loading ID</th>
				<th>Balance</th>
                <th>#</th>
                </tr>
                </thead>
                <tbody>

<?php $result = $db->prepare("SELECT * FROM bank WHERE date='$date' and action='0'");

					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){


				echo '<tr class="record">';



					   ?>


               <td><?php echo $row['id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['chq_no'];   ?></td>
              <td><?php echo $row['balance'];   ?></td>
<td>

<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>
</td>
                </tr>


				<?php }   ?>
				</tbody>

              </table>
            </div>



            </div>
            <!-- /.box-body -->
          </div>


</div>


        </div>
        <!-- /.col (left) -->



            <!-- /.box-body -->

            </div>
          </div>

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

<script src="js/jquery.js"></script>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
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





 <script type="text/javascript">

$(function () {
    $("#example1").DataTable();
    $("#example3").DataTable();
      $("#example4").DataTable();
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
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
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












</body>
</html>
