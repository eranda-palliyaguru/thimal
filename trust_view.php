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
       Trust
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Trust</li>
      </ol>
    </section>
   
   
   
   
   
   
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Trust Data</h3>
            </div>
            <!-- /.box-header -->
			 
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
				<th>ID</th>
                  <th>Customer Name</th>
                  <th>Product</th>
				  <th>Qty</th>
                  <th>Date</th>
                  <th>End Date</th>
                  <th>comment</th>
				  <th>Type</th>
                  <th>status</th>
				  <th>Clear</th>
				  
                  
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   
   $result = $db->prepare("SELECT * FROM trust   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				
				
			?>
                <tr class="record" >
				<td><?php echo $row['transaction_id'];?></td>
                  <td><?php echo $row['customer_name'];?></td>
				  
				  
				  
                  <td><?php echo $row['product'];?> </td>
				  <td><?php echo $row['qty'];?> </td>
                  <td><?php echo $row['date'];?></td>
                  <td><?php echo $row['end_date'];?></td>
                  <td><?php echo $row['comment'];?></td>
				  <td><small class="label pull-right bg-purple"><?php echo $row['type'];?></small></td>
                 

                  
                  <td><?php
				  
				  $dr=$row['status'];
				  if($dr=="active"){
					  
					echo  '<button class="btn btn-warning"><i class="icon-trash"><i class=" glyphicon glyphicon-cog fa-spin"></i></i></button>' ;
					  
					  

				  }
				  
				  $dr=$row['status'];
				  if($dr=="Processing."){
					  
					echo  '<button class="btn btn-success"><i class="icon-trash"><i class=" glyphicon glyphicon-refresh fa-spin"></i></i></button>' ;
					  
					  

				  }
				  
				  $dr=$row['status'];
				  if($dr=="Clear"){
					  echo  '<button class="btn btn-success"><i class="icon-trash">Clear</i></button>';
				  }
				  
				  
				  
				  ?></td>
				  <td>
				  <?php
				  
				  if($dr=="active"){
					  ?>
				 <a rel="facebox" href="trust_receive.php?id=<?php echo $row['transaction_id'];?>" > <button class="btn btn-warning"><i class="icon-trash">Receive</i></button></a>
				  <?php 
				}
				
				
				?>
				  
				  
				  </td>
				 
				  
				   <?php 
				}
				
				?>
                </tr>
               
                
                </tbody>
                <tfoot>
                
				
				
				
				
				
				
                </tfoot>
              </table>
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
<!-- ./wrapper -->
<script src="js/jquery.js"></script>
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
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

</body>

</html>
