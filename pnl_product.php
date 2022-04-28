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
if($r =='user'){

include_once("sidebar2.php");
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
        Credit Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

   <br>





   <section class="content">

     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Credit Report  </h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
	       <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
				   <th>Product</th>
				   <th>Price</th>
				    <th>QTY</th>
					<th>Cost Price</th>
				    <th>Margin</th>
			<th>Price Total</th>
			<th>Margin Total</th>
                </tr>
				
				</thead>

                <tbody>
<?php 	$date1=$_GET['d1'];
        $date2=$_GET['d2'];
        $product=$_GET['pro'];
			$m_total=0;
			$total=0;

$result2z = $db->prepare("SELECT name,price,price_id,sum(qty) FROM sales_list WHERE action='0' AND product_id='$product' AND date BETWEEN '$date1' AND '$date2' GROUP BY price ORDER BY price DESC");
$result2z->bindParam(':userid', $d2);
$result2z->execute();
for($i=0; $row = $result2z->fetch(); $i++){
	$price_id= $row['price_id'];
	$qty=$row['sum(qty)'];
                    ?>
                <tr>	
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['price']; ?></td>
		<td><?php echo $row['sum(qty)']; ?></td>	
        <td><?php 
	$result = $db->prepare("SELECT sell_price,o_price FROM price_update WHERE id='$price_id'");
$result->bindParam(':userid', $d2);
$result->execute();
for($i=0; $row1 = $result->fetch(); $i++){ echo $row1['o_price']; $op=$row1['o_price']; } ?></td>
        <td><?php  echo $mar=$row['price']-$op; ?></td>
			
		<td><?php echo $row['price'] * $row['sum(qty)']; ?></td>
		<td><?php echo $row['sum(qty)'] * $mar; ?></td>
				</tr>
<?php 
$total+=$row['price'] * $row['sum(qty)'];
$m_total+=$row['sum(qty)'] * $mar;
} ?>
                </tbody>


              </table>


<h3> Price Total:<?php echo $total; ?> </h3>
<h3> Margin Total:<?php echo $m_total; ?> </h3>



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
