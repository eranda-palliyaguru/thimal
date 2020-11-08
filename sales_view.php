
<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
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









    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Sales Report</li>
      </ol>
    </section>
	
	<br>
	

      <!-- SELECT2 EXAMPLE -->
	        
      
     <form action="sales_view.php" method="get">   
	<center>
	
			  
			  
			<strong>

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" /> 
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" />

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
</strong>  
			  
		<br>	  
			  
         <h4> Report from&nbsp;<i class=" text-primary "><?php echo $_GET['d1'] ?></i>&nbsp;to&nbsp;<i class=" text-primary "><?php echo $_GET['d2'] ?> </i>  </h4>
			 
			 </center>
			 </form>
			 
			

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Sales Report  <span class="pull-right badge bg-muted">Empty</span><span class="pull-right badge bg-yellow">Refill</span></h3>
		  
		  
		  
		  
		  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				  <th>Invoice</th>
                  <th>Customer</th>
                  <th>Lorry no</th>
				   <th>12.5kg</th>
				    <th>37.5kg</th>
					<th>5kg</th>
					<th>2kg</th>
				   <?php
				  $qty=0;
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");				
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];
				
	
			?>
				   <th><?php echo $row['gen_name']; ?></th>
				   <?php } ?>
                  
                </tr>
                </thead>
                <tbody>
				<?php
   
  
			
				
				
				date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
				
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
	
	

				
				
			?>
                <tr>
				
				
                  <td><?php echo $row['invoice'];?></td>
				  <td><?php echo $row['customer'];?></td>
				  
				  <td><?php echo $row['lorry_no'];?></td>
				  
				  
				  
				  
				
				<td><span class="pull-right badge bg-muted"><?php if($row['12_5kg_cylinders']>0){ echo $row['12_5kg_cylinders'];}?></span>
				
				<span class="pull-right badge bg-yellow"><?php if($row['12_5kg_gas']>0){ echo $row['12_5kg_gas'];}?></span></td>
			
				
				<td><span class="pull-right badge bg-muted"><?php  if($row['37_5kg_cylinders']>0){	 echo $row['37_5kg_cylinders'];}?></span>
			
				
				<span class="pull-right badge bg-yellow"><?php if($row['37_5kg_gas']>0){ echo $row['37_5kg_gas'];}?></span></td>
			
				
				<td><span class="pull-right badge bg-muted"><?php if($row['5kg_cylinders']>0){ echo $row['5kg_cylinders'];}?></span>
				<span class="pull-right badge bg-yellow"><?php if($row['5kg_gas']>0){ echo $row['5kg_gas'];}?></span></td>
				
				<td><span class="pull-right badge bg-muted"><?php if($row['2kg_cylinders']>0){ echo $row['2kg_cylinders'];}?></span>
				<span class="pull-right badge bg-yellow"><?php if($row['2kg_gas']>0){ echo $row['2kg_gas'];}?></span></td>
				
				
				<?php
				}			?>
				</tr>
                
                </tbody>
				
                <tfoot   class=" bg-aqua"   >
                <td  ></td><td  ></td>
				<td  >Total</td>
				
				<?php

				
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(12_5kg_cylinders) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2' ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			<td>
				<span class="pull-right badge bg-"><?php echo $row['sum(12_5kg_cylinders)'];?></span>
			<?php

				}

			
			?>
			<?php

				
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(12_5kg_gas) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			
				<span class="pull-right badge bg-yellow"><?php echo $row['sum(12_5kg_gas)'];?></span></td>
			<?php

				}

			
			?>
				



<?php

				
				$d1=$_GET['d1'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(37_5kg_cylinders) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			<td>
				<span class="pull-right badge bg-"><?php echo $row['sum(37_5kg_cylinders)'];?></span>
			<?php

				}

			
			?>
			<?php

				
				$d1=$_GET['d1'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(37_5kg_gas) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			
				<span class="pull-right badge bg-yellow"><?php echo $row['sum(37_5kg_gas)'];?></span></td>
			<?php

				}

			
			?>

<?php

				
				$d1=$_GET['d1'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(5kg_cylinders) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			<td>
				<span class="pull-right badge bg-"><?php echo $row['sum(5kg_cylinders)'];?></span>
			<?php

				}

			
			?>
			<?php

				
				$d1=$_GET['d1'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(5kg_gas) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			
				<span class="pull-right badge bg-yellow"><?php echo $row['sum(5kg_gas)'];?></span></td>
			<?php

				}

			
			?>


<?php

				
				$d1=$_GET['d1'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(2kg_cylinders) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			<td>
				<span class="pull-right badge bg-"><?php echo $row['sum(2kg_cylinders)'];?></span>
			<?php

				}

			
			?>
			<?php

				
				$d1=$_GET['d1'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum(2kg_gas) FROM sales_order WHERE  date BETWEEN '$d1' AND '$d2'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			
				<span class="pull-right badge bg-yellow"><?php echo $row['sum(2kg_gas)'];?></span></td>
			<?php

				}

			
			?>
				
				
				
                </tfoot>
              </table>
            </div>
			
			<center>
			
			
			
			<td><?php



			
			?>
			</td>
			</center>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
   
   
   

    <!-- Main content -->
    
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>






<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<
<!-- FastClick -->




<script src="js/jquery.js"></script>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../../plugins/chartjs/Chart.min.js"></script>
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
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
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







  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Collection? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "pay_dll.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>




<script>
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

</body>
</html>
