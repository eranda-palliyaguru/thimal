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
       Loading
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">damage</li>
      </ol>
    </section>
   
   
       <form action="loding_list.php" method="get">   
	<center>
	
			  
			  
			<strong>

Date :<input type="text" style="width:223px; padding:4px;" id="datepickerd" name="id" autocomplete="off"/> 

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
</strong>  
			
			 
			 </center>
			 </form>
   
   
   
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loading Data</h3>
            </div>
            <!-- /.box-header -->
			 
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Lorry No.</th>
                  <th>Driver</th>
                  <th>Cash</th>
                  <th>Date</th>
                  <th>Time</th>
				  <th>Action</th>
                  <th>View</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php 
				$cash_tot=0;
                $date=$_GET['id'];
                $result = $db->prepare("SELECT * FROM loading WHERE date='$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){				
								
			?>
                <tr class="record" >
				<td><?php echo $row['transaction_id'];?></td>
                  <td><?php echo $row['lorry_no'];?></td>
                  <td><?php $driver=$row['driver'];
			    $result1 = $db->prepare("SELECT * FROM employee WHERE  id='$driver'  ");			
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				echo $row1['name'];
				}?>
                  </td>
                  
                  <td>Rs.<?php echo $row['cash_total'];?></td>
                  <td><?php echo $row['date'];?></td>
					<td><?php echo $row['loading_time'];?></td>
				  
                  <td><?php  
				  $dr=$row['action'];
				  if($dr=="unload"){
					echo  '<small class="label pull-right bg-red">'.$dr.'</small>' ;
				  }			  
				  else{
					  echo  '<small class="label pull-right bg-green">'.$dr.'</small>';
				  }

				  ?></td>				  
				  <td>
				  <a href="loading_view.php?id=<?php echo $row['transaction_id'];?>"   title="Click to View" >
				  <button class="btn btn-info"><i class="icon-trash">view</i></button></a>
				  </td>		  
				   
                </tr> 
				<?php 
				$cash_tot+=$row['cash_total'];
				}	?>
                </tbody>
                <tfoot>
                
				
				
				
				
				
				
                </tfoot>
              </table>
				<h2>Cash Total - Rs<?php echo number_format($cash_tot,2); ?></h2>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
   
   
   

    <!-- Main content -->
    
      <!-- /.row -->

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
