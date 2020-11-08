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
	
	?>


    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <dvi style="color: red;font-size: 25px"> 
        <?php  $id=$_GET['id'];
		  $result = $db->prepare("SELECT * FROM customer WHERE customer_id='$id' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['customer_name'];
				}
				 ?> 
        <small>Invoice</small>
      </dvi>
		<a href="lorry_credit_view.php?cus=<?php echo $id; ?>">
	<button type="button" class="btn btn-block btn-danger btn-sm">#Credit</button></a> <br>
    </section>
	  <form action="save_lorry_sales.php" method="post">
	 <div class="row">
	<?php $result = $db->prepare("SELECT * FROM products WHERE    product_id < '5' ORDER by product_id ASC");			
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ 
				$proid=$row['product_id'];
					
		$result2 = $db->prepare("SELECT * FROM loading_list WHERE loading_id='$tid' and action='load' and  product_code='$proid'  ");
		$result2->bindParam(':userid', $res);
		$result2->execute();
		for($i=0; $row2 = $result2->fetch(); $i++){
		
		
		 ?>	  
		  
    
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
           <span class="info-box-icon bg-yellow"><img src="<?php echo $row['img'];?>" style="width: <?php echo $row['img_siz'];?>px"></span>

            <div class="info-box-content">
              <span  style="font-size: 25px"><?php echo $row['gen_name'];?></span>
              <span class="info-box-number">
				<input name="<?php echo $row['product_id'];?>" style="font-size: 30px; width:100px; color: red" type="number">(<?php echo $row2['qty_sold'];?>)</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		 
		 <?php } } ?>
		 
	
		 

		 
		<?php $result = $db->prepare("SELECT * FROM products WHERE    product_id > '4' and  product_id < '10' ORDER by product_id ASC");			
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ 
				$proid=$row['product_id'];
					
		$result2 = $db->prepare("SELECT * FROM loading_list WHERE loading_id='$tid' and action='load' and  product_code='$proid'  ");
		$result2->bindParam(':userid', $res);
		$result2->execute();
		for($i=0; $row2 = $result2->fetch(); $i++){
		
		
		 ?>
		 
<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
           <span class="info-box-icon bg-gray"><img src="<?php echo $row['img'];?>" style="width: <?php echo $row['img_siz'];?>px"></span>

            <div class="info-box-content">
              <span  style="font-size: 25px"><?php echo $row['gen_name'];?></span>
              <span class="info-box-number">
				<input name="<?php echo $row['product_id'];?>" style="font-size: 30px; width:100px; color: red" type="number">(<?php echo $row2['qty_sold'];?>)</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		 
		 <?php } } ?>
		 
        <!-- /.col -->
        	<?php $result = $db->prepare("SELECT * FROM products WHERE    product_id > '8' ORDER by product_id ASC");			
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ 
				$proid=$row['product_id'];
					
		$result2 = $db->prepare("SELECT * FROM loading_list WHERE loading_id='$tid' and action='load' and  product_code='$proid'  ");
		$result2->bindParam(':userid', $res);
		$result2->execute();
		for($i=0; $row2 = $result2->fetch(); $i++){
		
		
		 ?>	  
		  
    
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
           <span class="info-box-icon bg-yellow"><img src="<?php echo $row['img'];?>" style="width: <?php echo $row['img_siz'];?>px"></span>

            <div class="info-box-content">
              <span  style="font-size: 25px"><?php echo $row['gen_name'];?></span>
              <span class="info-box-number">
				<input name="<?php echo $row['product_id'];?>" style="font-size: 30px; width:100px; color: red" type="number">(<?php echo $row2['qty_sold'];?>)</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		 
		 <?php } } ?>
		  
		  
        <!-- /.col -->

        <!-- /.col -->
      </div>
	<div class="box box-info">
        <div class="box-header with-border">
         
         <input type="hidden"  name="cus_id" value="<?php echo $_GET['id']; ?>"  >		  
		  <input class="btn btn-block btn-info btn-sm" name="com" type="submit" value="Submit" >
			</form>
			
            </div>
          </div>	  
    <!-- Main content -->
    <section class="content">
<br><br>
      <!-- SELECT2 EXAMPLE -->
      
		  <a  href="sales_start.php"><button  class=" btn btn-success" style="width: 123px; height:35px; margin-:-8px;margin-left:8px;" >
				Back To Home 
                </button></a>
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
