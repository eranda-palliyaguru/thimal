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
?>




<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">
		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
    });
    </script>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        #Collection
        <small>Preview</small>
      </h1>

          <h3>Invoice No- <?php echo $id=$_GET['id'];
          $result = $db->prepare("SELECT * FROM sales  WHERE transaction_id='$id'   ");
          				$result->bindParam(':userid', $a);
                          $result->execute();
                          for($i=0; $row = $result->fetch(); $i++){
          	       echo "<br> Customer- ".$customer=$row['name'];
                        	}

           ?></h3>
    </section>

     <div class="row">
      <div id="screen"></div>

      <section class="content-header">
<center>

        <div class="col-md-10">
<form name="myForm" onsubmit="return validateForm()" action="lorry_credit_pay_save.php" method="post">
<input type="hidden" name="in_type" value="1">

  <select name="p_type" style="width: 190px;" class="form-control" id="p_type" onchange="view_payment_date(this.value);">
    <option value="cash">Cash</option>
          <option value="chq">Cheque</option>
                    </select>


   <div class="form-group" id='cash_pay' style="display:block;">
       <label for="exampleInputPassword1">Cash Amount</label>
     <p id="cash_amount1" style="color: red"></p>
       <div class="input-group">
         <input type="text" id="cash_amount" name="cash_amount"   onkeypress="postSet()" onfocus="this.value='';" class="form-control pull-right" autocomplete="off" >

     </div>
   <br>
     <input class="btn btn-info" type="submit" name="com" value="pay" >
  </div>


   <div class="form-group" id='chq_pay' style="display:none;">
       <label for="exampleInputPassword1">Cheque No</label>
       <div class="input-group">
         <input type="text" name="chq_no" class="form-control pull-right" id="chq_no" autocomplete="off" >
     <p id="chq_no1" style="color: red"></p>
     </div>
     <label for="exampleInputPassword1">Bank</label>
       <div class="input-group">
         <input type="text" name="bank" id="bank" class="form-control pull-right"> <p id="bank1" style="color: red"></p>
     </div>
     <label for="exampleInputPassword1">Amount</label>
       <div class="input-group">
         <input type="text" name="chq_amount" class="form-control pull-right" id="chq_amount" autocomplete="off" > <p id="chq_amount1" style="color: red"></p>
     </div>
      <label for="exampleInputPassword1">Date</label>
       <div class="input-group">
         <input type="text" name="chq_date" class="form-control pull-right" id="chq_date"  autocomplete="off" data-inputmask='"mask": "9999-99-99"' data-mask><p id="chq_date1" style="color: red"></p>
     </div>
    <br>
<input type="hidden" name="invo" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="tr_id" value="<?php echo $_GET['tr_id']; ?>">
<input class="btn btn-info" name="com" type="submit" value="Pay and Print" >
</form>
  </div>

  <div id="form_continue"></div>
            <!-- /btn-group -->
</center>
  </div>
      </section>

<br><br><br>
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


  function view_payment_date(type){
   if(type=='chq'){
 		document.getElementById('chq_pay').style.display='block';
 		document.getElementById('cash_pay').style.display='none';
 			}else if(type=='cash'){
 		document.getElementById('chq_pay').style.display='none';
 		document.getElementById('cash_pay').style.display='block';
 			}else {
 		document.getElementById('chq_pay').style.display='none';
 		document.getElementById('cash_pay').style.display='none';
 			}
 	 }



</script>
</body>
</html>
