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
        Credit Payment Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

   <br>


     <form action="sales_credit_pay.php" method="get">
	<center>





From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" />
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

		Customer :	<select class="form-control select2" name="cus" style="width: 350px;"  autofocus >
      <option value="all">Select Customer</option>

				  <?php
                $result = $db->prepare("SELECT * FROM customer ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name']; ?>    </option>
	<?php
				}
			?>
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
              <h3 class="box-title">Credit Payment Report  <a href="sales_credit_pay_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>&cus=<?php echo $_GET['cus'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
	       <table id="example1" class="table table-bordered table-striped">
        <thead>
				<tr>
				<th>Cus_id</th>
				<th>Customer</th>
				<th>Invoice</th>
				<th>Date</th>
				<th>Type</th>
				<th>CHQ No.</th>
				<th>Chq Date</th>
				<th>Amount</th>
				<th>#</th>
				</tr>
				</thead>

        <tbody>
				<?php
					$tot=0;
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y-m-d");
		$pay_type="";

				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$cus=$_GET['cus'];
	if($cus=="all"){$result2z = $db->prepare("SELECT * FROM payment WHERE sales_id > '0' AND   pay_credit='1' AND action > '0' AND date BETWEEN '$d1' and '$d2' ORDER BY customer_id ASC");
	}else{$result2z = $db->prepare("SELECT * FROM payment WHERE sales_id > '0' AND  customer_id='$cus' and pay_credit='1' AND action > '0' AND date BETWEEN '$d1' and '$d2'");}

				$result2z->bindParam(':userid', $d2);
        $result2z->execute();
        for($i=0; $row = $result2z->fetch(); $i++){
				$sales_id=$row['sales_id'];
        $pay_id=$row['transaction_id'];
$bulk="0";


		$result2 = $db->prepare("SELECT * FROM sales WHERE action='1' AND transaction_id='$sales_id'");
		$result2->bindParam(':userid', $d2);
    $result2->execute();
    for($i=0; $row2 = $result2->fetch(); $i++){
		 $invo=$row2['invoice_number'];
		 $pay_type=$row['type'];
		 $action=$row['action'];
		 $date1=$row2['date'];
		 $date =  date("Y-m-d");
				          $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);
					?>
        <tr>
				<td><?php echo $row['customer_id'];?></td>
				<td><?php echo $row2['name'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
      <?php
			$ter1=7;
			$tot+=$row['amount'];
			?>
		<td><?php	echo $row['type'];	?></td>
		<td><?php echo $row['chq_no'] ?></td>
		<td><?php	echo $row['chq_date']	?></td>
		<td><?php echo $row['amount']; ?></td>
		<td><?php if ($bulk==1) {
    echo "<a href='bulk_payment_print.php?id=".$pay_id."' title='Click to pay' ><button class='btn btn-primary'>View</button></a>";
      } ?></td>
				<?php
		} }
			?>
				</tr>
      <?php
        if ($cus=="all") {
                $pay_t = $db->prepare("SELECT * FROM credit_payment WHERE action='0' AND date BETWEEN '$d1' and '$d2' ORDER BY cus_id ASC");
                $bulk=1;
          }else {
                $pay_t = $db->prepare("SELECT * FROM credit_payment WHERE action='0' AND cus_id='$cus' AND date BETWEEN '$d1' and '$d2' ");
          }
                $pay_t->bindParam(':userid', $d2);
                $pay_t->execute();
                for($i=0; $row = $pay_t->fetch(); $i++){
                $sales_id=$row['sales_id'];
                $tr_id=$row['pay_id'];

      		$result2 = $db->prepare("SELECT * FROM sales WHERE action='1' AND transaction_id='$sales_id'");
      		$result2->bindParam(':userid', $d2);
          $result2->execute();
          for($i=0; $row2 = $result2->fetch(); $i++){
      		 $invo=$row2['invoice_number'];
      		 $pay_type=$row['type'];
      		 $action=$row['action'];
      		 $date1=$row2['date'];
      		 $date =  date("Y-m-d");
      				          $sday= strtotime( $date1);
                        $nday= strtotime($date);
                        $tdf= abs($nday-$sday);
                        $nbday1= $tdf/86400;
                        $rs1= intval($nbday1);
      					?>
        <tr>
				<td><?php echo $row['cus_id'];?><span class="pull-right badge bg-muted">BULK</span></td>
				<td><?php echo $row2['name'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
      <?php }
			$ter1=7;
			$tot+=$row['pay_amount'];

      $result2 = $db->prepare("SELECT * FROM payment WHERE transaction_id='$tr_id'");
      $result2->bindParam(':userid', $d2);
      $result2->execute();
      for($i=0; $row2 = $result2->fetch(); $i++){
			?>
		<td><?php	echo $row2['type'];	?></td>
		<td><?php echo $row2['chq_no'] ?></td>
		<td><?php	echo $row2['chq_date']	?></td>
		<td><?php echo $row['pay_amount']; ?></td>
		<td><?php echo "<a href='bulk_payment_print.php?id=".$tr_id."' title='Click to pay' ><button class='btn btn-primary'>View</button></a>"; ?></td>

    </tr>
        <?php
		} }
			?>

        </tbody>
    <tfoot class=" bg-blue" >
		<td  colspan="3" >Total</td>
		<td></td>
    <td></td>
		<td></td>

	<td></td>
  <td><span class="pull-left badge bg-muted"><?php echo $tot; ?></span></td>
  <td></td>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

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
