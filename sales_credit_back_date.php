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
$user_name=$_SESSION['SESS_FIRST_NAME'];

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


     <form  method="post">
	<center>

<?php
$qty=0;

 ?>



Date :<input type="text" style="width:223px; padding:4px;" name="date" id="datepicker"  value="" autocomplete="off" />

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
              <h3 class="box-title">Credit Report  <a href="sales_credit_print.php?r=<?php echo $_POST['r'] ?>&cus=<?php echo $_POST['cus'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
	       <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th colspan="4" ></th>

                </tr>

				<tr>
				<th>Cus_id</th>
				<th>Customer</th>
				<th>Invoice</th>
				<th>Date</th>



				<th>Type</th>
				<th>Amount</th>
				<th>Due</th>
				<th>SET OFF Date</th>
				<th>#</th>
				</tr>
				</thead>

                <tbody>
				<?php
					$tot=0;
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$pay_type="";
		$s_date="2020-01-01";
		$back_date=$_POST['date'];
$credit_pay=0;
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$cus=$_POST['cus'];
	if($cus=="all"){$result2z = $db->prepare("SELECT memo,sales_id,type,action,customer_id,pay_amount,amount,transaction_id,set_off_date FROM payment WHERE action > '0' AND type='credit' and date BETWEEN '$s_date' and '$back_date' ORDER BY customer_id ASC");
  }else{$result2z = $db->prepare("SELECT memo,sales_id,type,action,customer_id,pay_amount,amount,transaction_id,set_off_date FROM payment WHERE action > '0' AND type='credit' and customer_id='$cus' and date BETWEEN '$s_date' and '$back_date'");}

				$result2z->bindParam(':userid', $d2);
                $result2z->execute();
                for($i=0; $row = $result2z->fetch(); $i++){
				$sales_id=$row['sales_id'];



		$result2 = $db->prepare("SELECT * FROM sales WHERE action='1' AND transaction_id='$sales_id'");
			    $result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['invoice_number'];

		 $pay_type=$row['type'];
		$action=$row['action'];
		 $date1=$row['set_off_date'];
		if($date1==""){$date1=$back_date;}


			$date = $back_date;
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);

$first  = new DateTime( $date1 );
$second = new DateTime( $back_date );
$diff = $first->diff( $second );
$rs1= $diff->format( '%r%a' );
//$rs1=0;
	if($rs1 <= 0){
$credit_pay=0; $credit_pay1=0;
$pay_tr_id=$row['transaction_id'];
    $result = $db->prepare("SELECT sum(amount) FROM payment WHERE transaction_id > '$pay_tr_id' AND action > '0' AND collection_id='0' AND sales_id='$sales_id' and pay_credit='1' AND date BETWEEN '$s_date' and '$back_date' ");
        $result->bindParam(':userid', $d1);
              $result->execute();
              for($i=0; $row1 = $result->fetch(); $i++){
   $credit_pay1=$row1['sum(amount)'];
      }

      $result = $db->prepare("SELECT sum(pay_amount) FROM credit_payment WHERE tr_id='$pay_tr_id' AND  sales_id='$sales_id' and action='0' AND date BETWEEN '$s_date' and '$back_date' ");

          $result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){
      $credit_pay=$row1['sum(pay_amount)'];
        }

  $credit_pay=$credit_pay1+$credit_pay;

//$credit_pay=$credit_pay+$credit_pay1;
					?>
                <tr>
				<td><?php echo $row['customer_id'];?></td>
				<td><?php echo $row2['name'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>

<?php
				  $ter1=7;
			$tot+=$row['amount']-$credit_pay;
			?>

		<td><?php	echo $row['type'];	?></td>
		<td><?php echo number_format($row['amount']-$credit_pay,1);
			if($credit_pay>'0'){?><span class="pull-right badge bg-black"><?php	echo $credit_pay;?></span><?php } ?></td>
		<td><?php	echo $row['pay_amount']-$credit_pay;	?></td>
			<td><?php echo $row['set_off_date']; ?></td>
			<td><a href="bill2.php?id=<?php echo $row2['invoice_number'];?>"   title="Click to pay" >
				  <button class="btn btn-primary">View</button></a>
					</td>
					</tr>
				<?php
		 } }
				}


			?>



                </tbody>

                <tfoot   class=" bg-aqua"   >

				<td  colspan="3" >Total</td>




			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php echo number_format($tot,2); ?></span></td>

	<td></td><td></td><td></td>
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
