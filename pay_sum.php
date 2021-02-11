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
        Payment Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

   <br>


     <form action="pay_sum.php" method="get">
	<center>





From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" />
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

		Pay type :<select class="form-control select2" name="r" style="width: 350px;"  autofocus >


		<option value="cash">Cash</option>
		<option value="chq">Chq</option>
		<option value="credit">Credit</option>
    <option value="coupon">Coupon</option>
    <option value="bank">Bank</option>
    <option value="over">Overpayment</option>
    <option value="2kg">2Kg to 5Kg</option>

                </select>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>



		<br>



			 </center>
			 </form>


   <section class="content">

     <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Payment List  <a href="pay_sum_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>&r=<?php echo $_GET['r'] ?>"   title="Click to Print" >
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
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
			    $r=$_GET['r'];
$tot="";
$result1 = $db->prepare("SELECT * FROM sales WHERE  date BETWEEN '$d1' and '$d2' ");
$result1->bindParam(':userid', $c);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){

$in=$row1['transaction_id'];
$cus=$row1['name'];
$cashier=$row1['cashier'];



	$result = $db->prepare("SELECT * FROM payment WHERE  sales_id='$in' AND action >'0'  ORDER by transaction_id DESC");
				$result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
				$type=$row['type'];


	$result12 = $db->prepare("SELECT * FROM employee WHERE  id = '$cashier' ");
$result12->bindParam(':userid', $c);
$result12->execute();
for($i=0; $row12 = $result12->fetch(); $i++){
$dir=$row12['name'];

}


if($type==$r){


			?>

				<tr>
        <td><?php echo $in;?></td>
				<td><?php echo $cus;?></td>
				<td><?php echo $row1['lorry_no'];?></td>
				<td><?php echo $dir;?></td>
				<td><?php echo $row['type'];?></td>
				<td><?php echo $row['amount'];?></td>
				<td><?php echo $row['chq_no'];?></td>
				<td><?php echo $row['chq_date'];?></td>
				<td><?php echo $row['bank'];?></td>
<td><?php if ($user_lewal<4) { ?>
  <a rel="facebox" href="payment_edit.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-primary btn-xs"><b>Edit</b></a>
<?php } ?>
</td>
</tr>
<?php $tot+=$row['amount'];
} } }

$result = $db->prepare("SELECT * FROM payment WHERE date BETWEEN '$d1' and '$d2' AND action >'0' AND pay_credit='1' ORDER by transaction_id DESC");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$type=$row['type'];



if($type==$r){


?>

<tr style="background-color:#cccccc">
<td><?php // echo $in;?></td>
<td><?php // echo $cus;?></td>
<td>Credit set-off</td>
<td><?php // echo $dir;?></td>
<td><?php echo $row['type'];?></td>
<td><?php echo $row['amount'];?></td>
<td><?php echo $row['chq_no'];?></td>
<td><?php echo $row['chq_date'];?></td>
<td><?php echo $row['bank'];?></td>
<td><?php if ($user_lewal<4) { ?>
<a rel="facebox" href="payment_edit.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-primary btn-xs"><b>Edit</b></a>
<?php } ?>
</td>
				<?php $tot+=$row['amount'];
				 } }
				   ?></td>
                </tr>
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
