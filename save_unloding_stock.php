
<meta charset="utf-8">
<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$user_id=$_SESSION['SESS_MEMBER_ID'];

$lo_id=$_GET['id'];
//$qty_u=$_POST['qty'];

//$pro_cod = $_POST['product'];

$j = date("Y-m-d_h:i:sa");
$k = "load";

$result = $db->prepare("SELECT * FROM loading_list WHERE qty_sold < '0' AND loading_id='$lo_id' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$erorr="දාරිතාව ඉක්මවා Billකර ඇත කරුනාකර ඉවත්කිරීමට ඇති Bill ඉවත්කර නැවත උත්සාහ කරන්න";
	}
$result = $db->prepare("SELECT * FROM loading WHERE transaction_id ='$lo_id'  ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cash_total=$row['cash_total'];
$loding_action=$row['action'];
	}

$result = $db->prepare("SELECT sum(amount) FROM payment WHERE loading_id ='$lo_id' and type='cash' and action >'0' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$sum_amount=$row['sum(amount)'];
	}
	$result = $db->prepare("SELECT sum(amount) FROM collection WHERE  loading_id='$lo_id' AND pay_type='cash' and action ='0'  ");
	$result->bindParam(':userid', $c);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
	$c_cash=$row['sum(amount)'];
	}
$sum_amount=$sum_amount+$c_cash;

$result = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE loading_id ='$lo_id' and m_type='3' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ex_amount=$row['sum(amount)'];
$sum_amount=$sum_amount-$ex_amount;
$dep=$cash_total-$sum_amount;
	}

if($sum_amount>$cash_total){$erorr="ඇතුලත් කර මුදල් ප්‍රමානයත් සමග තිබිය යුතු මුදල නොගැලපේ කරුනාකර #cash_sum පරික්ශාකර නැවත උත්සාහ කරන්න <br>
*#CASH_SUM තුලින් ඇතුලත් කර මුදල් නෝට්ටු ගනන නිවැරදිදැයි නැවත පරික්ශාකර බලන්න<br>
*අමතර වියදං වූවානං කරුනාකර #Expenses තුලින් ඇතුලත් කරන්න
<h3>(අඩු මුදල රු".$dep.")</h3>";}

if($loding_action=="unload"){$erorr="<h2>මේවනවිටත් unload කර ඇත.</h2> හරකෙක් වගේ නැවත නැවතත් උත්සාහ කිරීමෙන් වලකින්න";}

if(!$erorr){

$result = $db->prepare("SELECT * FROM loading_list WHERE loading_id='$lo_id' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty_u=$row['qty_sold'];
$pro_cod=$row['product_code'];
$p_name=$row['product_name'];
$id=$row['transaction_id'];
$date=$row['date'];

$sql = "UPDATE products
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty_u,$row['product_code']));

$sql = "UPDATE loading_list
        SET unload_qty=unload_qty+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty_u,$id));




$result1 = $db->prepare("SELECT * FROM products WHERE product_id= :userid  ");
$result1->bindParam(':userid', $pro_cod);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$qty=$row1['qty'];


$sql = "UPDATE loading_list
        SET yard_before=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));


$sql = "UPDATE loading
        SET unloading_time=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($j,$id));

}


$time=date("h:i.a");
$action=1;
$type=2;
$sql = "INSERT INTO stock_log (product_id,qty,product_name,date,time,action,source_id,yard_qty,type,user_id) VALUES (:b,:f,:i,:j,:ti,:k,:m,:lb,:ty,:us)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$pro_cod,':f'=>$qty_u,':i'=>$p_name,':j'=>$date,':k'=>$action,':m'=>$lo_id,':lb'=>$qty,':ti'=>$time,':ty'=>$type,':us'=>$user_id));


}
$result = $db->prepare("SELECT * FROM loading_list WHERE loading_id=$lo_id ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$idr=$row['transaction_id'];
$un="unload";
$sql = "UPDATE loading_list
        SET action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($un,$idr));
}


//$to_sum="0";
$result = $db->prepare("SELECT sum(loading_id) FROM loading_list WHERE loading_id=$lo_id and action='load' ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$to_sum=$row['sum(loading_id)'];
}


if(!$to_sum){
$sql = "UPDATE loading SET action='unload' WHERE transaction_id ='$lo_id'";
$q = $db->prepare($sql);
$q->execute(array($qty,$c));

$sql = "UPDATE lorry SET action='unload' WHERE loading_id ='$lo_id'";
$q = $db->prepare($sql);
$q->execute(array($qty,$c));
}
header("location: unload_print.php?id=$lo_id");
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
                <?php echo $erorr ?>
              </div></div>  <br><br><br>
	<div class="col-md-2">
	<a href="unloding_stock.php?id=<?php echo $lo_id;?>">
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
