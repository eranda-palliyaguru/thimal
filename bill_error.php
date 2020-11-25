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
                  <th>invoice_no</th>
                  <th>Date</th>
                  <th>customer</th>
                  <th>Product</th>
                  <th>qty</th>
                  <th>price</th>
                  <th>total</th>
                  <th>dif</th>
                  <th>View</th>
                </tr>

                </thead>

                <tbody>
				<?php
        include('connect.php');
        date_default_timezone_set("Asia/Colombo");

        $result = $db->prepare("SELECT * FROM special_price ");
            $result->bindParam(':userid', $res);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){
        $customer_id=$row['customer_id'];
        $product_id=$row['product_id'];
        $price_o=$row['price'];
        $customer=$row['customer'];

        $result1 = $db->prepare("SELECT * FROM sales_list WHERE action='0' AND cus_id='$customer_id' AND product_id='$product_id' ");
            $result1->bindParam(':userid', $res);
            $result1->execute();
            for($i=0; $row1 = $result1->fetch(); $i++){
              $name=$row1['name'];
              $qty=$row1['qty'];
              $price=$row1['price'];
              $amount=$row1['amount'];
              $loading_id=$row1['loading_id'];
              $invoice_no=$row1['invoice_no'];
              $date=$row1['date'];

              $result122 = $db->prepare("SELECT * FROM products WHERE product_id='$product_id'  ");
                  $result122->bindParam(':userid', $res);
                  $result122->execute();
                  for($i=0; $row122 = $result122->fetch(); $i++){
                  $pro_price =$row122['price'];
                  }



        $cal=$price*$qty;
        $cal2=$pro_price*$qty;

            if ($amount == $cal) {}else {



?>
                  </td>

                  <td><?php $result122 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invoice_no'  ");
                  		$result122->bindParam(':userid', $res);
                  		$result122->execute();
                  		for($i=0; $row122 = $result122->fetch(); $i++){
                  		echo  $row122['transaction_id'];
                  		}?></td>
                  <td><?php echo $row1['date'];?></td>
					<td><?php echo $row['customer'];?></td>

                  <td><?php echo $row1['name']; ?></td>
                  <td><?php echo $row1['qty']; ?></td>
                  <td><?php echo $row1['price']; ?></td>
                  <td><?php echo $row1['amount']; ?> <p class="text-green">(<?php echo number_format($cal,2) ; ?>)</p> </td>
                  <td><?php echo $amount-$cal; ?></td>
				  <td>
				  <a href="bill2.php?id=<?php echo $row1['invoice_no'];?>"   title="Click to View" >
				  <button class="btn btn-info">view</button></a>
				  </td>

                </tr>
				<?php

				}	} }?>
                </tbody>
                <tfoot>







                </tfoot>
              </table>
				<h2></h2>
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
