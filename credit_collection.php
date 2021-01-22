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
$user_lewal=$_SESSION['USER_LEWAL'];
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
      Credit  Payment Report
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
              <h3 class="box-title"> Credit Payment List  <a href="credit_pay_sum_print.php"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>Invoice no </th>
				<th>Customer</th>
				<th>Lorry no</th>
				<th>Driver</th>
        <th>Pay type</th>
				<th>Amount </th>
        <th>Chq no</th>
				<th>Chq Date</th>
				<th>Bank</th>
        <th>#</th>
				</tr>
                </thead>
                <tbody>
				<?php
               include("connect.php");
     $tot="";



	$result = $db->prepare("SELECT * FROM collection WHERE   type ='0' AND action='0'  ORDER by id DESC");
				$result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
				$user=$row['user_id'];
        	$loading=$row['loading_id'];

        $result1 = $db->prepare("SELECT * FROM user WHERE id ='$user' ");
      				$result1->bindParam(':userid', $date);
              $result1->execute();
              for($i=0; $row1 = $result1->fetch(); $i++){
                $dir=$row1['username'];
              }


              $result1 = $db->prepare("SELECT * FROM loading WHERE transaction_id ='$loading' ");
            				$result1->bindParam(':userid', $loading);
                    $result1->execute();
                    for($i=0; $row1 = $result1->fetch(); $i++){
                      $action=$row1['action'];
                    }
if ($action=="load") {
echo '<tr style="background-color:#f0f296">';
}else {
echo "<tr>";
}
			?>


        <td><?php echo $row['invoice_no'];?></td>
				<td><?php echo $row['customer'];?></td>
				<td><?php echo $row1['loading_id'];?></td>
				<td><?php echo $dir;?></td>
				<td><?php echo $pay_type=$row['pay_type'];?></td>
				<td><?php echo $row['amount'];?></td>
				<td><?php echo $row['chq_no'];?></td>
				<td><?php echo $row['chq_date'];?></td>
				<td><?php echo $row['bank'];?></td>
<td><?php if ($user_lewal < 4) {  if($action=="unload") {  if ($pay_type=="chq") {
?>
  <a rel="facebox" href="credit_collection_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs"><b>Edit</b></a> <?php } ?>
  <a href="credit_collection_save.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-connectdevelop fa-info"></i>Process</a>
<?php } } ?>
</td>
</tr>
<?php $tot+=$row['amount'];
 }
?>

                </tbody>
                <tfoot>
				<td colspan="5"></td>
				<td>Rs.<?php echo $tot;?></td>
				<td colspan="3"></td>
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
