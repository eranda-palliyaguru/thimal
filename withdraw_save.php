<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$date1=date("Y-m-d");

$type = $_POST['type'];
$amount = $_POST['amount'];
$reci = $_POST['reci'];
$com = $_POST['com'];
$date = $_POST['i_date'];

$er=5;

$first  = new DateTime( $date );
$second = new DateTime( $date1 );
$diff = $first->diff( $second );
echo $diff->format( '%r%a' );
$fat=$diff->format( '%r%a' );

if($fat > 3 ){ $er=1; }
if($fat < 0 ){ $er=1; }


if($er=="5"){

if($type=="1"){header("location: withdraw.php");}


if($type=="Bank"){
	$sql = "UPDATE bank_balance 
        SET amount=amount-?";
$q = $db->prepare($sql);
$q->execute(array($amount));	
}

if($type=="Bank"){ $type1=4; $bank = $_REQUEST['bank']; $chq_no=0;$chq_date=$date;}
if($type=="Chq"){ $type1=5; $bank="SAMPATH BANK";
$chq_no = $_POST['ch_no'];
$chq_date = $_REQUEST['chq_date'];
				}




$resultz = $db->prepare("SELECT * FROM bank_balance  ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$balance=$rowz['amount'];
}


$lor=0;

$mt=1;
//echo $customer_name;
$cashier=$_SESSION['SESS_MEMBER_ID'];


$sql = "INSERT INTO bank (date,type,amount,bank,balance,chq_no,chq_date,receive,cashier,payment_id) VALUES (:da,:ty,:am,:bn,:ba,:c_no,:c_da,:cid,:cshi,:pay_id)";
$q = $db->prepare($sql);
$q->execute(array(':da'=>$date,':am'=>$amount,':ba'=>$balance,':ty'=>$type1,':bn'=>$bank,':c_no'=>$chq_no,':c_da'=>$chq_date,':cid'=>$reci,':cshi'=>$cashier,':pay_id'=>""));

$resultz = $db->prepare("SELECT * FROM bank ORDER by id DESC limit 0,1 ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$source=$rowz['id'];
}



$sql = "INSERT INTO expenses_records (date,type,chq_no,amount,balance,loading_id,comment,m_type) VALUES (:date,:a,:b,:amount,:ba,:so,:lo,:mt)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':b'=>$chq_no,':date'=>$date,':amount'=>$amount,':ba'=>'0',':so'=>$source,':lo'=>$com,':mt'=>$type1));

header("location: withdraw.php");
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
                The date is out of range
              </div></div>  <br><br><br>
	<div class="col-md-2">
	<a href="expenses.php">
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