<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue layout-top-na">
<?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){

include_once("sidebar2.php");
}
if($r =='admin'){

//include_once("sidebar.php");
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
        #SUM
        <small>Preview</small>
      </h1>
    </section>

	  <?php
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

	$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$tid' AND type='cash' and action >'0'  ORDER by transaction_id DESC");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$cash_tot=$row['sum(amount)'];
				}

        $result = $db->prepare("SELECT sum(amount) FROM collection WHERE  loading_id='$tid' AND pay_type='cash' and action ='0'  ");
      	$result->bindParam(':userid', $c);
      	$result->execute();
      	for($i=0; $row = $result->fetch(); $i++){
      	$c_cash=$row['sum(amount)'];
      	}
	  ?>

     <div class="row">
      <div id="screen"></div>

<div class="col-md-6">
              <div class="form-group"><br>

                <label>#SUM</label>
				<form method="get" action="save_lorry_sum.php">


				</div>


				   <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th><i class="fa fa-money"></i></th>
				<th>QTY</th>
				<th>Amount</th>

				</tr>
                </thead>
                <tbody>
				<tr>
                <td>5000</td>
				 <td><input type="number" name="r5000" onkeyup="sum();" id="r5000" ></td>
				<td><input id="r5000r"  disabled></td>
                </tr>
				<tr>
                <td>2000</td>
				 <td><input type="number" name="r2000" onkeyup="sum();" id="r2000"></td>
				<td><input id="r2000r"  disabled></td>
                </tr>
				<tr>
                <td>1000</td>
				 <td><input type="number" name="r1000" id="r1000" onkeyup="sum();" ></td>
				<td><input id="r1000r"  disabled></td>
                </tr>
				<tr>
                <td>500</td>
				 <td><input type="number" name="r500" id="r500" onkeyup="sum();"></td>
				   <td><input id="r500r"  disabled></td>
                </tr>
				<tr>
                <td>100</td>
				 <td><input type="number" name="r100" id="r100" onkeyup="sum();"></td>
					<td><input id="r100r"  disabled></td>
                </tr>
				<tr>
                <td>50</td>
				 <td><input type="number" name="r50" id="r50" onkeyup="sum();"></td>
					<td><input id="r50r"  disabled></td>
                </tr>
				<tr>
                <td>20</td>
				 <td><input type="number" name="r20" id="r20" onkeyup="sum();"></td>
					<td><input id="r20r"  disabled></td>
                </tr>
				<tr>
                <td>10</td>
				 <td><input type="number" name="r10" id="r10" onkeyup="sum();"></td>
					<td><input id="r10r"  disabled></td>
                </tr>
				<tr>
                <td><i class="fa fa-database"></i> Coine (කාසි)</td>
				 <td><input type="number" name="coin" id="coin" onkeyup="sum();"></td>
					<td><input id="coinr"  disabled></td>
                </tr>
                </tbody>
                <tfoot>
					<tr>
                <td>Total</td>
				 <td><input type="text" name="total" id="total" onkeyup="sum();" disabled>
					<input type="hidden" name="total" id="total1" onkeyup="sum();" >
						<input type="hidden" name="id" value="<?php echo $tid;?>"  ></td>
                </tr>
                </tfoot>
              </table>

			<h2 style="color: red">Cash - Rs.<?php echo $cash_tot+$c_cash; ?></h2>

		<input class="btn btn-info" type="submit" value="Submit" >
				  </form>
              </div><br><br><br>
        <!-- /.col -->
	<div class="col-md-2"><a href="sales_start.php">
	<button type="button" class="btn btn-block btn-success btn-sm">Home</button></a>  </div><br>
        <!-- /.col -->
      </div>
    <!-- Main content -->



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



function sum() {

            var r5000 = document.getElementById('r5000').value*5000;
            var r2000 = document.getElementById('r2000').value*2000;
	        var r1000 = document.getElementById('r1000').value*1000;
            var r500 = document.getElementById('r500').value*500;
	var r100 = document.getElementById('r100').value*100;
	var r50 = document.getElementById('r50').value*50;
	var r20 = document.getElementById('r20').value*20;
	var r10 = document.getElementById('r10').value*10;
	var coin = document.getElementById('coin').value*1;


 var result = parseInt(r5000) + parseInt(r2000) + parseInt(r1000) + parseInt(r500) + parseInt(r100) + parseInt(r50) + parseInt(r20) + parseInt(r10) + parseInt(coin)   ;
            if (!isNaN(result)) {
                document.getElementById('total').value = result;
				document.getElementById('total1').value = result;
				document.getElementById('r5000r').value = r5000;
				document.getElementById('r2000r').value = r2000;
				document.getElementById('r1000r').value = r1000;
				document.getElementById('r500r').value = r500;
				document.getElementById('r100r').value = r100;
				document.getElementById('r50r').value = r50;
				document.getElementById('r20r').value = r20;
				document.getElementById('r10r').value = r10;
				document.getElementById('coinr').value = coin;
            }
        }
</script>
</body>
</html>
