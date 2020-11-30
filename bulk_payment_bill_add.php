<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$error_id="m";
$date=date("Y-m-d");


$invo = $_POST['invo'];
$amount = $_POST['amount'];
$pay_id = $_POST['id'];

if($invo=="qb"){
  $sales_id="00";
  $c_amount="00";
  $cus_id="00";
  $type="qb";
  $invo="00";
  $cus="old bill";
 }else{


$resultz = $db->prepare("SELECT * FROM credit_payment WHERE tr_id='$invo' AND action='2' AND  pay_id='$pay_id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$error_id=$rowz['id'];
}


$resultz = $db->prepare("SELECT * FROM payment WHERE transaction_id='$invo'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$sales_id=$rowz['sales_id'];
$c_amount=$rowz['amount'];
$cus_id=$rowz['customer_id'];
$type=$rowz['type'];
}

$resultz = $db->prepare("SELECT * FROM customer WHERE customer_id='$cus_id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$cus=$rowz['customer_name'];
}

if ($c_amount < $amount) {
$error_id=1;
}
}

if ($error_id=="m") {
$act=2;


$sql = "INSERT INTO credit_payment (tr_id,sales_id,pay_id,pay_amount,credit_amount,cus_id,date,action,cus,type) VALUES (:tr_id,:s_id,:p_id,:p_amo,:c_amo,:cus,:date,:act,:cus_n,:type)";
$q = $db->prepare($sql);
$q->execute(array(':tr_id'=>$invo,':s_id'=>$sales_id,':p_id'=>$pay_id,':p_amo'=>$amount,':c_amo'=>$c_amount,':cus'=>$cus_id,':date'=>$date,':act'=>$act,':cus_n'=>$cus,':type'=>$type));


header("location: bulk_payment.php?id=$pay_id");
}else{
?>
<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body>



<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>

    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->



	<div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php if ($error_id==1) {
              echo "The amount paid is more than the credit amount";
            }else {
              echo "This Bill already ADD";
            } ?>

              </div></div>  <br><br><br>
	<div class="col-md-2">
	<a href="bulk_payment.php?id=<?php echo $pay_id; ?>">
	<button type="button" class="btn btn-block btn-success btn-sm">Back</button></a>
	   </div>

	  <?php	}	?>
    <!-- /.content -->


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
</script>
</body>
</html>
