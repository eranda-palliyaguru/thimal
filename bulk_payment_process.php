<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$olld=0;
$now=date("Y-m-d");


$pay_id = $_POST['pay_id'];


$resultz = $db->prepare("SELECT * FROM payment WHERE  transaction_id='$pay_id'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$chq_amount=$rowz['amount'];
$pay_action=$rowz['action'];
}

$resultz = $db->prepare("SELECT sum(pay_amount) FROM credit_payment WHERE  pay_id='$pay_id' AND action='2'  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$pay_tot=$rowz['sum(pay_amount)'];
}

if ($pay_action > 0) {
header("location: bulk_payment.php");
$pay_tot=0;
}

if ($chq_amount == $pay_tot) {

  $resultz = $db->prepare("SELECT * FROM credit_payment WHERE  pay_id='$pay_id' AND action='2' ");
  $resultz->bindParam(':userid', $inva);
  $resultz->execute();
  for($i=0; $rowz = $resultz->fetch(); $i++){
  $pay_amount=$rowz['pay_amount'];
  $tr_id=$rowz['tr_id'];
  $credit_id=$rowz['id'];
  $type=$rowz['type'];


  if ($type=="qb") {
    // code...
  }else {


  $sql = "UPDATE payment
          SET pay_amount=pay_amount+?
  		WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($pay_amount,$tr_id));


  $result = $db->prepare("SELECT * FROM payment  WHERE transaction_id='$tr_id'   ");
  				$result->bindParam(':userid', $a);
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
  	            $balance1=$row['pay_amount'];
  			      	$am=$row['amount'];
  				      $loding_id=$row['loading_id'];
  				      $sales_id=$row['sales_id'];
  			      	$cus_id=$row['customer_id'];
  			        $invo=$row['invoice_no'];
  				}

          if($am <= $balance1){
          $ex="1";
          $sql = "UPDATE payment
                  SET action=?
          		WHERE transaction_id=?";
          $q = $db->prepare($sql);
          $q->execute(array($ex,$tr_id));


          $set_off=date('Y-m-d');
          $sql = "UPDATE payment
                  SET set_off_date=?
              WHERE transaction_id=?";
          $q = $db->prepare($sql);
          $q->execute(array($set_off,$tr_id));
          }

          $ex="1";
          $sql = "UPDATE payment
                  SET credit_pay_id=?
              WHERE transaction_id=?";
          $q = $db->prepare($sql);
          $q->execute(array($pay_id,$tr_id));

          $sql = "UPDATE payment
                  SET customer_id=?
              WHERE transaction_id=?";
          $q = $db->prepare($sql);
          $q->execute(array($cus_id,$pay_id));

}
          $c_act='0';
          $sql = "UPDATE credit_payment
                  SET action=?
              WHERE id=?";
          $q = $db->prepare($sql);
          $q->execute(array($c_act,$credit_id));



  }

  $ex="2";
  $sql = "UPDATE payment
          SET action=?
      WHERE transaction_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($ex,$pay_id));

  $sql = "UPDATE collection
          SET type=?
      WHERE pay_id=?";
  $q = $db->prepare($sql);
  $q->execute(array($ex,$pay_id));


header("location: bulk_payment_print.php?id=$pay_id");
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
                Unbalance CHQ amount to Payment total
              </div></div>  <br><br><br>
	<div class="col-md-2">
	<a href="bulk_payment.php?id=<?php echo $_POST['pay_id']; ?>">
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
