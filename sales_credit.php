<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue sidebar-mini  demo">
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
        Debtor Report
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
      <div class="box box-warning">

               <div class="box-header">
                 <h3 class="box-title">Filter</h3>
               </div>

     <form method="get">

       <div class="form-group">


       	<div class="box-body">

<div class="row">
    <div class="col-md-6">
      <div class="form-group">
  <div class="input-group">
   <div class="input-group-addon">
        <b>Type</b>
          </div>
          <select class="form-control select2" name="type"  >
            <option value="all">Total Debtors</option>
            <option value="due">Overdue Debtors</option>
                      </select>
          </div>
          </div>
</div>

<div class="col-md-6">
  <div class="form-group">
<div class="input-group">
<div class="input-group-addon">
    <b>	Customer</b>
      </div>
      <select class="form-control select2" name="cus"  >
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
      </div>
      </div>
</div>
</div>



<div class="row">
<div class="col-md-6">
  <div class="form-group">
<div class="input-group">
<div class="input-group-addon">
    <b>   Customer Group :</b>
      </div>
      <select class="form-control select2" name="group"  >
        <option value="all">Select Group</option>

            <?php
                  $result = $db->prepare("SELECT * FROM customer_category ");
      $result->bindParam(':userid', $res);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
      ?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>    </option>
      <?php
          }
        ?>
                  </select>
      </div>
      </div>
</div>


<div class="col-md-6">
  <div class="form-group">
<div class="input-group">
<div class="input-group-addon">
    <b>Lorry</b>
      </div>
      <select class="form-control select2" name="lorry"  >
      <option value="all"> All Lorry </option>

      <?php
      $result = $db->prepare("SELECT * FROM lorry ORDER by lorry_id ASC ");
      $result->bindParam(':userid', $res);
      $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
      ?>
      <option ><?php echo $row['lorry_no']; ?>    </option>
      <?php
      }
      ?>
      </select>
      </div>
      </div>
</div>

</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
<div class="input-group">
<div class="input-group-addon">
    <b>Customer Type</b>
      </div>
      <select class="form-control select2" name="customer_type"  >
          <option value="all">All Customer</option>
          <option value="1">Channel</option>
          <option value="2">commercial</option>
          <option value="3">Apartment</option>
          </select>
      </div>
      </div>
</div>

</div>
<br>
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>



		<br>




			 </form>
</div></div></div> </section>

   <section class="content">

     <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Debtor Report  <a href="sales_credit_print.php?type=<?php echo $_GET['type'] ?>&cus=<?php echo $_GET['cus'] ?>&group=<?php echo $_GET['group'] ?>&lorry=<?php echo $_GET['lorry'] ?>&customer_type=<?php echo $_GET['customer_type'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a>
    <a href="sales_credit_age_print.php?type=<?php echo $_GET['type'] ?>&cus=<?php echo $_GET['cus'] ?>&group=<?php echo $_GET['group'] ?>&lorry=<?php echo $_GET['lorry'] ?>&customer_type=<?php echo $_GET['customer_type'] ?>"   title="Click to Print" >
  <button class="btn btn-danger">Print (Age)</button></a></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
	       <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th colspan="4" ></th>
				    <th colspan="5" >#</th>
                </tr>

				<tr>
				<th>Cus_id</th>
				<th>Customer</th>
				<th>Invoice</th>
				<th>Date</th>


				<th>Limit</th>
				<th>Amount</th>
				<th>Overdue</th>
				<th>Memo</th>
				<th>#</th>
				</tr>
				</thead>

                <tbody>
				<?php
					$tot=0;
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$pay_type="";

    $type=$_GET['type'];
    $customer_id=$_GET['cus'];
     $group=$_GET['group'];
     $lorry=$_GET['lorry'];
     $customer_type=$_GET['customer_type'];

     if($customer_id=="all"){
     if($group=="all"){

     if ($customer_type=="all") {
     $customer = $db->prepare("SELECT customer_id,credit_period FROM customer  ORDER BY category DESC");
     }else {
     $customer = $db->prepare("SELECT customer_id,credit_period FROM customer WHERE type='$customer_type' ORDER BY category DESC");
     }

     }else {
     $customer = $db->prepare("SELECT customer_id,credit_period FROM customer WHERE category='$group' ORDER BY category DESC");
     }
       		}else{
     	$customer = $db->prepare("SELECT customer_id,credit_period FROM customer WHERE customer_id='$customer_id' ORDER BY category DESC "); }

   $customer->bindParam(':userid', $d2);
   $customer->execute();
   for($i=0; $row_cus = $customer->fetch(); $i++){
    $cus=$row_cus['customer_id'];
     $limit=$row_cus['credit_period'];


   $b_tot=0;
   $pay_tot=0;

   $result2z = $db->prepare("SELECT memo,sales_id,type,action,customer_id,pay_amount,amount,transaction_id FROM payment WHERE action='2' and type='credit' and customer_id='$cus'");
    $result2z->bindParam(':userid', $d2);
    $result2z->execute();
    for($i=0; $row = $result2z->fetch(); $i++){
    $sales_id=$row['sales_id'];

   if ($lorry=='all') {
   $result2 = $db->prepare("SELECT date,name,lorry_no,invoice_number FROM sales WHERE action='1' AND transaction_id='$sales_id'");
   }else {
   $result2 = $db->prepare("SELECT date,name,lorry_no,invoice_number FROM sales WHERE action='1' AND transaction_id='$sales_id' AND lorry_no='$lorry' ");
   }
      $result2->bindParam(':userid', $d2);
      $result2->execute();
      for($i=0; $row2 = $result2->fetch(); $i++){
    //  $invo=$row2['invoice_number'];

   $pay_type=$row['type'];
   $action=$row['action'];


    $date1=$row2['date'];
   $date =  date("Y-m-d");
      $sday= strtotime( $date1);
               $nday= strtotime($date);
               $tdf= abs($nday-$sday);
               $nbday1= $tdf/86400;
               $rs1= intval($nbday1);

               if($type=='due'){ $leval=$rs1-$limit;	}else { $leval=$rs1; }
               $coo=$limit;
               $rs1=$rs1-$limit;



   if($leval >= 0){
   $color="";$color1="";
   if($rs1>=30){$color="#f0f296"; $color1="black";}
   if($rs1>=60){$color="#701144"; $color1="white";}
      ?>

        <tr style="background-color: <?php echo $color; ?>; color: <?php echo $color1; ?>">
				<td ><?php echo $row['customer_id'];?></td>
				<td><?php echo $row2['name'];?></td>
				<td><?php echo $row['sales_id'];?>
        <span class="pull-right badge bg-green"><?php echo $row2['lorry_no'];?> </span></td>
				<td><?php echo $row2['date'];?></td>


<?php
				  $ter1=7;
			$tot+=$row['amount']-$row['pay_amount'];
			?>


		<td><?php	echo $row_cus['credit_period'];	?> Day</td>
		<td><?php echo $row['amount']-$row['pay_amount'];
			$b_tot+=$row['amount']-$row['pay_amount'];
			if($row['pay_amount']>'0'){?><span class="pull-right badge bg-black"><?php	echo $row['pay_amount'];?></span><?php } ?></td>
		<td><?php	echo $rs1;	?> Day</td>
			<td><?php echo $row['memo'];
			?></td>
			<td><?php if($user_lewal < 4){?><a rel="facebox" href="payment_view_view.php?id=<?php echo $row['sales_id'];?>&pay_amount=<?php echo $row['pay_amount'];?>&pay_id=<?php echo $row['transaction_id'];?>&cus=<?php echo $_GET['cus'];?>"   title="Click to pay" >
				  <button class="btn btn-success">Set Payment</button></a><?php } ?>
					<a href="bill2.php?id=<?php echo $row2['invoice_number'];?>"   title="Click to pay" >
				  <button class="btn btn-primary">View</button></a>
					</td>
					</tr>
				<?php
  //    }
		} }
				}

			if($b_tot > 1){
			?>
					   <tr   class=" bg-gray"   >
						   <td><?php echo $cus;?></td>

				<td >Total</td>
  <td></td>


			<td></td><td></td>
		<td><span class="pull-right badge bg-red"><?php echo number_format($b_tot,1); ?></span></td>

	<td></td><td></td><td></td>
                </tr>
	<?php
//$tot+=$b_tot;
} } ?>



                </tbody>

                <tfoot   class=" bg-aqua"   >

				<td  colspan="3" >Total</td>


			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php echo number_format($tot,1); ?></span></td>

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
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
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
