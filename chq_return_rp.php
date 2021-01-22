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

include_once("sidebar2.php");
}
if($r =='admin'){

include_once("sidebar.php");
}



	?>




<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
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
       CHQ Return
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">loading</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">CHQ Return</h3>



			<div class="form-group">

		<form method="post" action="chq_return_save.php">

        <div class="box-body">

          <div class="row">
			  <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>CHQ Type</label></div>
   <select class="form-control select2" name="type" id="pay_type" onchange="view_payment_date(this.value);" >
        <option value="0">Select Type</option>
		<option value="1">Deposit CHQ</option>
	    <option value="2">Issue CHQ</option>

                  </select> </div></div>
	</div>








<div id='deposit' style="display:none;" > <br>
	      <div class="row">
	 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>CHQ No</label></div>
     <select class="form-control select2" name="chq_no1"  style="width: 100%;" >
                         <?php
                $result = $db->prepare("SELECT * FROM bank WHERE  type='1' AND chq_action='0'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){

			$d_date=$row['chq_date'];
			$date=date('Y-m-d');

$first  = new DateTime( $d_date );
$second = new DateTime( $date );
$diff = $first->diff( $second );
$def= $diff->format( '%r%a' );

			if($def<30){

	?>

		 <option value="<?php echo $row['id']; ?>"><?php echo $row['chq_no']."_".$row['bank']; ?></option>
  	<?php
			}	}
			?>
                  </select> </div></div>

	 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>Reason</label></div>
<input type="text" value='' name="reason1" class="form-control" tabindex="2" >
 </div></div>

 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>Charges</label></div>
<input type="number" value='' name="charges1" class="form-control" tabindex="2" >
 </div></div></div></div>






 			<div id='withdraw' style="display:none;" > <br>
	      <div class="row">
	 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>CHQ No</label></div>
     <select class="form-control select2" name="chq_no"  style="width: 100%;" >
                         <?php
                $result = $db->prepare("SELECT * FROM bank WHERE  type='5' or type='3'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){

			$d_date=$row['chq_date'];
			$date=date('Y-m-d');

$first  = new DateTime( $d_date );
$second = new DateTime( $date );
$diff = $first->diff( $second );
$def= $diff->format( '%r%a' );

			if($def<30){

	?>

		 <option value="<?php echo $row['id']; ?>"><?php echo $row['chq_no']."_".$row['receive']; ?></option>
  	<?php
			}	}
			?>
                  </select> </div></div>

	 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>Reason</label></div>
<input type="text" value='' name="reason" class="form-control" tabindex="2" >
 </div></div>

 <div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
          <label>Charges</label></div>
<input type="number" value='' name="charges" class="form-control" tabindex="2" >
 </div></div></div></div>
          </div>
		 <input class="btn btn-info" type="submit" value="Submit" >
			</form>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->


    <!-- /.content -->


		 	<div class="box-body">
      <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID</th>
				<th>Date</th>
				<th>Type</th>
				<th>Amount (Rs.)</th>
                <th>Return Charges</th>
				<th>CHQ No</th>
				<th>CHQ Date</th>
				<th>Balance</th>
                <th>#</th>
                </tr>
                </thead>
                <tbody>

<?php $result = $db->prepare("SELECT * FROM return_chq WHERE  action='0' ");

					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo '<tr class="record">';
					   ?>
               <td><?php echo $row['id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
					<td><?php echo $row['charges'];   ?></td>
				<td><?php echo $row['chq_no'];   ?></td>
				<td><?php echo $row['chq_date'];   ?></td>
              <td><?php echo $row['balance'];   ?></td>
<td>
</td>
                </tr>


				<?php }   ?>
				</tbody>

              </table>
		</div>

	</div>  </div>  </section>
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

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>


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
   url: "chq_return_dll.php",
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
<!-- Page script -->
<script>
   $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

   $(".select2").select2();

  });


	$(".select2").select2();

	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });




 function view_payment_date(type){
	if(type=='1'){
	document.getElementById('deposit').style.display='block';
	document.getElementById('withdraw').style.display='none';

		} else if(type=='2'){
		document.getElementById('deposit').style.display='none';
	    document.getElementById('withdraw').style.display='block';

			}else {
          document.getElementById('deposit').style.display='none';
	      document.getElementById('withdraw').style.display='none';

			}
	 }

</script>
</body>
</html>
