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
        CUSTOMER
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Customer</li>
      </ol>
    </section>
   
   
   
   
   
   
   
   <section class="content">
   
     <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Customer Data</h3>
			   <a rel="facebox" href="customer_add.php" >
				  <button class="btn btn-info"><i class="icon-trash">Add Customer</i></button></a>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
				  <th>id</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Contact No</th>
				 <th>Type</th>
                  <th>Root</th>
                  <th>Area</th>
				  <th>#</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   
   $result1 = $db->prepare("SELECT * FROM customer   ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$cus_id=$row1['customer_name'];
					
		
					
			   $result = $db->prepare("SELECT * FROM customer  WHERE customer_name='$cus_id'  ORDER by customer_id DESC  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
               <tr class="record" >
				 <td><?php echo $row1['customer_id'];?></td>
                  <td><?php echo $row['customer_name'];?>
                  </td>
                  <td><?php echo $row['address'];?></td>
                  <td><?php echo $row['contact'];?></td>
					
				 <td><?php 
					$cus_cus=$row1['customer_id'];
					$result12 = $db->prepare("SELECT * FROM special_price WHERE customer_id='$cus_cus'  ");
				$result12->bindParam(':userid', $date);
                $result12->execute();
                for($i=0; $row12 = $result12->fetch(); $i++){
				$cus_id_1=$row12['customer_id'];
					if($cus_id_1 >'1'){?><button class="btn btn-warning">special_price</button><?php } ?>
					<?php } ?>
				   
				   <?php 
					$cus_cus=$row1['customer_id'];
					$result13 = $db->prepare("SELECT * FROM sales WHERE customer_id='$cus_cus'  ");
				$result13->bindParam(':userid', $date);
                $result13->execute();
                for($i=0; $row13 = $result13->fetch(); $i++){
				$cus_id_2=$row13['customer_id'];
					if($cus_id_2 >'1'){?><button class="btn btn-success">Bill</button><?php } ?></td>
					<?php } ?>
				   
				  <td><?php echo $row['root'];?></td>
				  <td><?php echo $row['area'];?></td>
                  <td><a href="customer_dll.php?id=<?php echo $row1['customer_id']; ?>" id="<?php echo $row1['customer_id']; ?>" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>
					
					<a rel="facebox" href="customer_edit.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-primary btn-xs"><b>Edit</b></a>
					</td>
				  
				   <?php 
				}
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
 if(confirm("Sure you want to delete this customer? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "customer_dll.php",
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
