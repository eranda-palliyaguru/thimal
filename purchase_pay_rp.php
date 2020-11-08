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

header("location:./../../../index.php");
}
if($r =='admin'){

include_once("sidebar.php");
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
        Bank Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   <br>
   

     <form method="get">   
	<center>
	
			  
			  
			

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" /> 
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/> 


 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
 
			  
		<br>	  
			  
      
			 
			 </center>
			 </form> 
   
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bank Report  <a href="bank_rp_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>ID</th>
					<th>#</th>
					<th>Date</th>
				<th>Type</th>
				<th>Amount (CREDIT)</th>
				<th>Amount (DEBIT)</th>
				<th>CHQ no/Loading id</th>
                  <th>Comment</th>
					<th>CHQ Date</th>
					<th>Invoice No</th>

                </tr>
                </thead>
<tbody>
			
<?php 
	$d1=$_GET["d1"];
	$d2=$_GET["d2"];
	$result = $db->prepare("SELECT * FROM bank WHERE  action='0' and type='3' and date BETWEEN '$d1' and '$d2' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
				  
				 
					$m_type=$row['type']; 
					
				
					   ?>
<tr>
			
               <td ><?php echo $row['id'];   ?> </td>
	       <td ><?php if($row['type']<"3"){  ?><span class="pull-right badge bg-green" >CREDIT</spa> <?php } ?>
	          <?php if($row['type']=="3"){  ?><span class="pull-right badge bg-red" >DEBIT</spa> <?php } ?>
			  
	</td>
	
	       <td><?php echo $row['date'];   ?> </td>
		<td>
<?php if($row['type']=="3"){  ?><span class="pull-right badge bg-green" >LAUGFS Gas PLC</span><?php } ?>
</td>
	
	
	<td></td>
	<td><?php  echo "Rs.".$row['amount']; ?></td>
	<td><?php echo $row['chq_no'];   ?></td>
				<td><?php echo $row['bank'];   ?></td>
   <td><?php echo $row['chq_date']; ?></td>
	<td><a href="purchase_invoice_view.php?d1=<?php echo $row['payment_id']; ?>"><?php echo $row['payment_id']; ?></a></td>
                  
                </tr>

				<?php } ?>
				</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
   </div>
  <!-- /.content-wrapper -->
<?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
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
  
   $(".select2").select2();
  
  });
	
	
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });
	
</script>
</body>
</html>
