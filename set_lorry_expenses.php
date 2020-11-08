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
       #Expenses
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
		 $lorry_no=$row['lorry_no'];
		}


	  ?>
	  
	  
	  
     <div class="row">
      
		 
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Expenses</h3>

		  
		  
		 
		  
		  
		  
		  
           
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_lorry_expenses.php">
		
        <div class="box-body">
		
		
		
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Type</label>
                <select class="form-control select2" name="type" style="width: 100%;" autofocus tabindex="1" >
                  <option value="">.</option>
                  
				  <?php
				  $date= date("Y-m-d");
				  $ttr="incomplete";
                $result = $db->prepare("SELECT * FROM expenses_types ");
		$result->bindParam(':userid', $ttr);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option>Diesel</option>
		<option>Parking Ticket</option>
	<?php
				}
			?>
                </select>
				
				</div>
              </div>
			   
			   
          
            <div class="col-md-6">
              <div class="form-group">
				  
				  
				   <label>	Amount</label>
                <input type="text" value='' name="amount" class="form-control pull-right" tabindex="2" >         
				  
				  
                
                  
                  
				  
                </input>
                  
                  </div>
				</div></div>
              
			  
			  <div class="row">
              <div class="col-md-6">
              <div class="form-group">
               <label>Comment</label>
                <input type="text" value=''  name="comment" class="form-control pull-right" tabindex="3">
				  
				  
				  
				  
                  </div>
				</div>
				
				
				
			
              
                <input type="hidden" value='<?php  echo date("Y/m/d"); ?> ' id="datepicker" name="date" class="form-control pull-right" tabindex="4" >
                  
              
				
				</div>		   
			  <div class="form-group">
              
				
        
		
        </div>
      </div>
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
				
        
			  <input type="hidden" name="loading_id" value="<?php echo $tid; ?>">
			  <input type="hidden" name="lorry" value="<?php echo $lorry_no; ?>">
			  <input class="btn btn-info" type="submit" value="Submit" >
			  
			  </form>
			  
			  
			  <div class="cctv">
			  
			  </div>
			  
			  </div></div></div></div>
			  
		</section>
	  
	  
	  		 <section class="content">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Collection List</h3> 
            </div>
            <div class="box-body">
             
			 
			 
			 
			 
			 <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>ID</th>
					
				<th>Type</th>
				<th>Amount (Rs.)</th>
                  <th>Comment</th>
					
			
                  
					
                  
				  
                </tr>
                </thead>
<tbody>
			
<?php $result = $db->prepare("SELECT * FROM expenses_records WHERE loading_id='$tid' and action='0'");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				 
					   
					   
					 
				echo '<tr class="record">';
				
					   
					   
					   ?>

			
               <td><?php echo $row['sn'];   ?> </td>
	      
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
				<td><?php echo $row['comment'];   ?></td>
              
                  
                  
				  
                  
                  
                </tr>
				
				
				<?php }   ?>
				</tbody>
                
              </table>
            </div>	
			 
			 
			 
            </div>
            <!-- /.box-body -->
          </div>

		  
</div>
		  
		  
        </div>
        <!-- /.col (left) -->
       

        
            <!-- /.box-body -->
            
            </div>
          </div>

    </section>
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
	var coin = document.getElementById('coin').value;
	
	
 var result = parseInt(r5000) + parseInt(r2000) + parseInt(r1000) + parseInt(r500) + parseInt(r100) + parseInt(r50) + parseInt(r20) + parseInt(r10)    ;
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
