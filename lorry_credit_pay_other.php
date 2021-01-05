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
        #SUM
        <small>Preview</small>
      </h1>

      <div class="col-md-6">
<?php  $id=$_GET['id'];

$result = $db->prepare("SELECT * FROM collection WHERE id='$id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
//	$invo=$row['invoice_no'];
$chq_amount=$row['amount'];
}


 $result = $db->prepare("SELECT sum(pay_amount) FROM credit_payment WHERE collection_id='$id' AND action='2' ");
$result->bindParam(':userid', $ttr);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$pay_tot=$row['sum(pay_amount)']; }
$balance=$chq_amount-$pay_tot;

if ($balance<0) {
echo "<h1 style='color:red'>";
}else {
echo "<h1 style='color:green'>";
}
?>

        Balance <?php echo $balance; ?></h1>
      </div>
    </section>

     <div class="row">

      <section class="content-header">
<center>

        <div class="col-md-10">
<form onsubmit="return validateForm()" action="lorry_credit_pay_save.php" method="post">


  <label>Invoice NO</label>
  <select class="form-control select2" name="tr_id" style="width: 100%;" autofocus>
<?php
$result = $db->prepare("SELECT * FROM payment WHERE type='credit' AND action='2' ");
$result->bindParam(':userid', $ttr);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$customer_id=$row['customer_id'];

$result11 = $db->prepare("SELECT * FROM customer WHERE customer_id ='$customer_id' ");
$result11->bindParam(':userid', $res);
$result11->execute();
for($i=0; $row11 = $result11->fetch(); $i++){
$name=$row11['customer_name'];
}
?>
<option value="<?php echo $row['transaction_id'];?>"><?php echo $row['sales_id']; ?> __ <?php echo $name; ?> __Rs.<?php echo $row['amount']-$row['pay_amount']; ?>  </option>
<?php
}
?>

<br><br> <br>



       <div class="input-group">
         <input type="text" name="amount"  class="form-control" autocomplete="off" >

     </div>

<input type="hidden" name="in_type" value="2">
<input type="hidden" name="id" value="<?php echo  $_GET['id']; ?>">
     <input class="btn btn-info" type="submit" name="com" value="pay" >
</form>



  <div id="form_continue"></div>
            <!-- /btn-group -->
</center>
<br><br>
  </div>
      </section>
      <table  class="table table-bordered table-striped">
        <thead>
        <tr>
  <th>ID</th>
  <th>Invoice no</th>
<th>Customer</th>
<th>Credit Amount (Rs.)</th>
<th>Pay Amount (Rs.)</th>




          <th>#</th>

        </tr>
        </thead>
<tbody>

<?php $id=$_GET['id'];
$result = $db->prepare("SELECT * FROM credit_payment WHERE collection_id='$id' AND action='2' ");

  $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
echo '<tr class="record">';

     ?>


       <td><?php echo $row['id'];   ?> </td>
 <td><?php echo $row['sales_id'];   ?> </td>
<td><?php echo $row['cus'];   ?> </td>
<td>Rs.<?php echo $row['credit_amount'];   ?></td>
<td><?php echo $row['pay_amount'];   ?></td>

<td>

<a href="lorry_credit_pay_dll.php?id=<?php echo $row['id'];   ?>&pay_id=<?php echo $_GET['id'];   ?>"   title="Click to Delete" >
  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>


</td>
        </tr>


<?php }   ?>
</tbody>

      </table>
<br><br><br>

<?php
$id=$_GET['id'];
$resultz = $db->prepare("SELECT * FROM collection WHERE  id='$id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
  $chq_amount=$rowz['amount'];
    $type=$rowz['pay_type'];
    if ($type=="chq") {
 ?>

  <div class="col-sm-2 col-md-5 ">
    <div class="callout callout-warning">
                   <h4 class="pull-left"><?php echo $rowz['bank']; ?></h4>
                    <h4 class="pull-right"><?php echo $rowz['chq_date']; ?></h4>
<br><br>
<h4>Thimal Enterprises (Pvt.) Ltd </h4>
<hr>
<button type="button" class="btn btn-default btn-lg pull-right">Rs. <?php echo $rowz['amount']; ?></button>
                    <br><br>

                  <center>  <h4> <hr>  <?php echo $rowz['chq_no']; ?>   -xxxxx': xxxxxxxx;'</h4></center>
                  </div>
             </div>
<?php } if ($type=="bank") { ?>
<div class="col-sm-2 col-md-5 ">
  <div class="callout callout-">
<h2>Bank Transfer</h2>
                <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
            <th>Reference No.</th>
            <th><?php echo $rowz['chq_no']; ?></th>
                  </tr>

                  <tr>
            <th>Bank</th>
            <th><?php echo $rowz['bank']; ?></th>
                  </tr>

                  <tr>
            <th>date</th>
            <th><?php echo $rowz['chq_date']; ?></th>
                  </tr>

                  <tr>
            <th>Amount</th>
            <th><?php echo $rowz['amount']; ?></th>
                  </tr>

            </thead>
            </table>

                </div>
           </div>



         <?php } if ($type=="cash") { ?>
         <div class="col-sm-2 col-md-5">
           <div class="callout callout-">


    <img src="money.png" alt="" style="width:150px">
                         <table  class="table table-bordered table-striped">
                           <thead>



                           <tr>
                     <th>Type</th>
                     <th>Cash</th>
                           </tr>

                           <tr>
                     <th>Amount</th>
                     <th><?php echo $rowz['amount']; ?></th>
                           </tr>

                     </thead>
                     </table>

                         </div>
                    </div>
<?php } } ?>

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
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
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
