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
$sec=1;
$page=$_SESSION['page'];
if ($page=="END") { ?>
<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales_start.php'">
<?php } ?>




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
        Sales Form
        <small>Preview</small>
      </h1>
    </section>




    <!-- Main content -->
    <section class="content">
<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Sales Pay</h3>

			<table id="example2" class="table table-bordered table-hover">
			<tr>
                <th>Product Name</th>
				<th>QTY</th>

                <th>Price (Rs.)</th>
				<th>Total (Rs.)</th>
              </tr>
		<?php
		$total=0;
		$invo=$_GET['id'];
$_SESSION['posttimer'] = time();
		$result1 = $db->prepare("SELECT sum(amount) FROM payment WHERE invoice_no='$invo'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$pay_total=$row1['sum(amount)'];
		}

		$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$invo' ");
		$result->bindParam(':userid', $invo);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
				 <tr  >
				     <td><?php echo $row['name']; ?></td>
					 <td><?php echo $row['qty']; ?></td>

					 <td><?php echo $row['price']; ?></td>
					 <td><?php echo $row['amount']; ?></td>

				 <?php  $total+=$row['amount']; ?>
				 </tr>
				 <?php
		}	?>

			 </table>

			<h5>Bill Total Rs.<?php  echo $total; ?></h5>
			<h5>Pay Total Rs.<?php  echo $pay_total; ?></h5>
			<h4 style="color: red">Balance Rs.<?php  echo $total-$pay_total; ?></h4>

<?php if ($_SESSION['error']=='') {}else { ?>
      <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
<?php echo $_SESSION['error']; ?>
</div> <?php } $_SESSION['error']=""; ?>
<center>

         	<div class="col-md-10">
				<h3>ගෙවීම් සම්පූර්ණ කරන්න</h3>
	<form action="save_sales_pay.php" method="post">


		<select name="p_type" style="width: 190px;  " class="form-control" id="p_type" onchange="view_payment_date(this.value);">
			<option value="cash">Cash</option>
            <option value="credit">Credit</option>
            <option value="chq">Cheque</option>
			<option value="coupon">Coupon</option>
      <option value="2kg">2kg to 5kg promotion</option>
                      </select>

   <div class="form-group" id='credit_pay' style="display:none;">
<br>
	<input class="btn btn-info" type="submit" name="com" value="print" >
     <br><br><br>
     <label for="exampleInputPassword1">Memo</label>
     <div class="input-group">
       <input type="text"  name="credit_memo" onkeypress="postSet()" onfocus="this.value='';" class="form-control pull-right" autocomplete="off" >
    </div>

      <br>

		</div>


		 <div class="form-group" id='cash_pay' style="display:block;">
         <label for="exampleInputPassword1">Cash Amount</label>
         <div class="input-group">
           <input type="text" id="ff" name="cash_amount" onkeypress="postSet()" onfocus="this.value='';" class="form-control pull-right" autocomplete="off" >
       </div>
     <br>
			  <input class="btn btn-info" type="submit" name="com" value="pay" >
		</div>


		 <div class="form-group" id='chq_pay' style="display:none;">
         <label for="exampleInputPassword1">Cheque No</label>
         <div class="input-group">
           <input type="text" name="chq_no" class="form-control pull-right" autocomplete="off" >
       </div>
			 <label for="exampleInputPassword1">Bank</label>
         <div class="input-group">
           <input type="text" name="bank" class="form-control pull-right">
       </div>
			 <label for="exampleInputPassword1">Amount</label>
         <div class="input-group">
           <input type="text" name="chq_amount" class="form-control pull-right" autocomplete="off" >
       </div>
			  <label for="exampleInputPassword1">Date</label>
         <div class="input-group">
           <input type="text" name="chq_date" class="form-control pull-right" autocomplete="off" data-inputmask='"alias": "yyyy-mm-dd"' data-mask>
       </div>
      <br>
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
	<input class="btn btn-info" name="com" type="submit" value="Pay and Print" >
	</form>
		</div>

		<div class="form-group" id='coupon' style="display:none;">
	<form action="save_sales_pay.php" method="post">
	<input type="hidden" name="p_type" value="coupon">
         <label for="exampleInputPassword1">Amount</label>
         <div class="input-group">
       <input type="text" name="cup_amount" class="form-control pull-right" autocomplete="off" >
       </div>
	   <label for="exampleInputPassword1">Coupon NO.</label>
         <div class="input-group">
           <input type="text" name="cup_no" class="form-control pull-right">
       </div>


      <br>
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
	<input class="btn btn-info" name="com" type="submit" value="Pay and Print" >
	</form>
		</div>

    <div class="form-group" id='2kg' style="display:none;">
<form action="save_sales_pay.php" method="post">
	<input type="hidden" name="p_type" value="2kg">

	   <label for="exampleInputPassword1"><span class="info-box-icon bg-">
       <img src="icon/2.png" style="width: 40px"><input type="number" name="2kg" class="form-control pull-right"></span></label>

<br><br>

      <br>
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
	<input class="btn btn-info" name="com" type="submit" value="Pay and Print" >
	</form>
		</div>

		</center>
		<div id="form_continue"></div>
	            <!-- /btn-group -->



		</div>

    <table id="example1" class="table table-bordered table-striped">
             <thead>
             <tr>

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
$result = $db->prepare("SELECT * FROM payment WHERE   invoice_no='$invo'   ORDER by transaction_id DESC");
     $result->bindParam(':userid', $date);
             $result->execute();
             for($i=0; $row = $result->fetch(); $i++){
     $invo=$row['invoice_no'];

   ?>

     <tr>

       <td><?php echo $row['type'];?></td>
      <td><?php echo $row['amount'];?></td>
      <td><?php echo $row['chq_no'];?></td>
     <td><?php echo $row['chq_date'];?></td>
     <td><?php echo $row['bank'];?></td>

     <?php
     }
        ?></td>
             </tr>
             </tbody>
             <tfoot>
             </tfoot>
           </table>
            </div>
          </div>
      <!-- SELECT2 EXAMPLE -->


          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->

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
	if(type=='credit'){
	document.getElementById('credit_pay').style.display='block';
	document.getElementById('cash_pay').style.display='none';
	document.getElementById('chq_pay').style.display='none';
	document.getElementById('coupon').style.display='none';
  document.getElementById('2kg').style.display='none';
		} else if(type=='chq'){
		document.getElementById('chq_pay').style.display='block';
		document.getElementById('credit_pay').style.display='none';
		document.getElementById('cash_pay').style.display='none';
		document.getElementById('coupon').style.display='none';
    document.getElementById('2kg').style.display='none';
			}else if(type=='cash'){
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('credit_pay').style.display='none';
		document.getElementById('cash_pay').style.display='block';
		document.getElementById('coupon').style.display='none';
    document.getElementById('2kg').style.display='none';
			}else if(type=='coupon'){
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('credit_pay').style.display='none';
		document.getElementById('cash_pay').style.display='none';
    document.getElementById('2kg').style.display='none';
		document.getElementById('coupon').style.display='block';
  }else if(type=='2kg'){
document.getElementById('chq_pay').style.display='none';
document.getElementById('coupon').style.display='none';
document.getElementById('credit_pay').style.display='none';
document.getElementById('cash_pay').style.display='none';
document.getElementById('2kg').style.display='block';
			}else {
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('credit_pay').style.display='none';
		document.getElementById('cash_pay').style.display='none';
		document.getElementById('coupon').style.display='none';
    document.getElementById('2kg').style.display='none';
			}
	 }

</script>
  <script type="text/javascript">
$(function() {


$('input[name=com]').click(function(){

//Save the link in a variable called element
$(this).hide();

//Find the id of the link that was clicked


});

});
</script>
</body>
</html>
