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
 <script type="text/javascript">

		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });

    });

    </script>





   <script src='js/jquery-1.12.3.js'></script>
 <script src='js/jquery.dataTables.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
   <script>


      $(document).ready(function(){
      	$('button').click(function(){
      		$('.cctv').load('terms3.php');

      	});

      });




   </script>




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Invoice Removal
        <small>Preview</small>
      </h1>
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
          <h3 class="box-title"> Invoice Removal</h3>









        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="bill_remove_save.php">

        <div class="box-body">



          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Invoice</label>
                <select class="form-control select2" name="invoice" style="width: 100%;" autofocus tabindex="1" >

				  <?php
				  $date= date("Y-m-d");
				  $ttr="incomplete";
                $result = $db->prepare("SELECT * FROM sales WHERE action='1' ORDER BY transaction_id DESC  limit 0,20000");
		$result->bindParam(':userid', $ttr);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['transaction_id'];?>"><?php echo $row['transaction_id']."  ".$row['name']; ?> </option>
	<?php
				}
			?>
                </select>

				</div>
              </div>



            <div class="col-md-6">
              <div class="form-group">


				   <label>Reason</label>
<input class="form-control " name="reason" style="width: 100%;" autofocus tabindex="1" >




                  </div>
				</div></div>



			  <div class="form-group">




        </div>
      </div>


      <!-- /.box -->
<div class="form-group">





			  <input class="btn btn-info" type="submit" value="Submit" >

			  </form>


			  <div class="cctv">

			  </div>

			  </div></div></div></div>

		</section>
          <!-- /.box -->



		 <section class="content">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"> List</h3>
            </div>
            <div class="box-body">





			 <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>Invoice No.</th>
					<th>Date</th>
				<th>Customer</th>
				<th>Amount (Rs.)</th>
                  <th>Reson</th>




                  <th>#</th>

                </tr>
                </thead>
<tbody>

<?php $date=date("Y-m-d");
$result = $db->prepare("SELECT * FROM sales WHERE remove > '0'  ");
					$result->bindParam(':userid', $date);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
				echo '<tr class="record">';
					   ?>
         <td><?php echo $row['transaction_id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['name'];   ?> </td>
	      <td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['reason'];   ?></td>





<td>

<a href="bill2.php?id=<?php echo $row['invoice_number']; ?>"  title="Click to view" >
				  <button class="btn btn-info"><i class="icon-trash">View</i></button></a>


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
