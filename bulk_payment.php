<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
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
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">

		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });

    });

    </script>





   <script src='js/jquery-1.12.3.js'></script>
 <script src='js/jquery.dataTables.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
   <script>


      $(document).ready(function(){
      	$('button').click(function(){
      		$('.cctv').load('terms3.php');

      	});

      });




   </script>




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Payment
        <small>Preview</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">CHQ</h3>









        <!-- /.box-header -->
		<div class="form-group">

<?php if (!$_GET['id']) { ?>

        <div class="box-body">



          <form method="post" action="bulk_payment_save.php">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>CHQ NO</label>
                <input type="text" name="chq_no" class="form-control pull-right" value="">

				</div>
              </div>



            <div class="col-md-6">
              <div class="form-group">


				   <label>	Amount</label>
                <input type="text" value='' name="amount" class="form-control pull-right" tabindex="2" >

                  </div>
				</div></div>


			  <div class="row">
              <div class="col-md-6">
              <div class="form-group">
               <label>Bank</label>
                <input type="text" value=''  name="bank" class="form-control pull-right" tabindex="3">
                  </div>
				         </div>

               <div class="col-md-6">
              <div class="form-group">
				   <label>	Date</label>
                <input type="text" value='<?php  echo date("Y-m-d"); ?> ' id="datepicker" name="date" class="form-control pull-right" tabindex="4" >
                  </div>
				          </div>
				</div>

        <div class="form-group">
        </div>
        <input class="btn btn-info" type="submit" value="Submit" >
        </form>
        </div>
    <?php  }else {
 ?>

      <!-- /.box -->
<div class="form-group">
<div class="row">




<?php
$pay_id=$_GET['id'];
$resultz = $db->prepare("SELECT * FROM payment WHERE  transaction_id='$pay_id' ");
$resultz->bindParam(':userid', $inva);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
  $chq_amount=$rowz['amount'];
 ?>

  <div class="col-sm-2 col-md-5 pull-right">
    <div class="callout callout-warning">
                   <h4 class="pull-left"><?php echo $rowz['bank']; ?></h4>
                    <h4 class="pull-right"><?php echo $rowz['chq_date']; ?></h4>
<br><br>
<h4>Thimal Enterprises (Pvt.) Ltd </h4>
<hr>
<button type="button" class="btn btn-default btn-lg pull-right">Rs. <?php echo $rowz['amount']; ?></button>
                    <br><br>

                  <center>  <h4> <hr>  <?php echo $rowz['chq_no']; ?>   -xxxxx': xxxxxxxx;'</h4></center>
                  </div>
             </div>
<?php } ?>

  <form method="post" action="bulk_payment_bill_add.php">
             <div class="col-md-4">
             <div class="form-group">
              <label>Invoice NO</label>
              <select class="form-control select2" name="invo" style="width: 100%;" autofocus>
        <?php
  $result = $db->prepare("SELECT * FROM payment WHERE type='credit' AND action='2' ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $customer_id=$row['customer_id'];

    $result11 = $db->prepare("SELECT * FROM customer WHERE customer_id ='$customer_id' ");
        $result11->bindParam(':userid', $res);
        $result11->execute();
        for($i=0; $row11 = $result11->fetch(); $i++){
          $name=$row11['customer_name'];
        }
  ?>
  <option value="<?php echo $row['transaction_id'];?>"><?php echo $row['sales_id']; ?> __ <?php echo $name; ?> __Rs.<?php echo $row['amount']-$row['pay_amount']; ?>  </option>
  <?php
      }
    ?>
              </select>
                 </div>
                </div>

              <div class="col-md-2">
                <label>Pay Amount</label>

              <div class="input-group input-group-sm">
                 <input type="text"  name="amount" class="form-control " tabindex="4" >
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Add to list</button>
                    </span>
              </div>
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
               </form>
                 </div>


                 <div class="col-md-4">
                                  <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                                Please click process button to complete the process.
                                              </div> </div>


                 <div class="col-md-6">
<?php   $result = $db->prepare("SELECT sum(pay_amount) FROM credit_payment WHERE pay_id='$pay_id' AND action='2' ");
  $result->bindParam(':userid', $ttr);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $pay_tot=$row['sum(pay_amount)']; }
$balance=$chq_amount-$pay_tot;

if ($balance<0) {
echo "<h1 style='color:red'>";
}else {
  echo "<h1 style='color:green'>";
}
    ?>

                   Balance <?php echo $balance; ?></h1>
                 </div>




        </div></div>
        <div class="col-md-2 pull-right">

<form  action="bulk_payment_process.php" method="post">
<input type="hidden" name="pay_id" value="<?php echo $_GET['id']; ?>">
        <button class="btn btn-block btn-lg btn-danger " type="submit" >
                        <i class="fa fa-connectdevelop fa-info"></i> Process
                      </button>
                      </form>
                      </div>
        <table  class="table table-bordered table-striped">
          <thead>
          <tr>
    <th>ID</th>
    <th>Invoice no</th>
  <th>Customer</th>
  <th>Credit Amount (Rs.)</th>
  <th>Pay Amount (Rs.)</th>




            <th>#</th>

          </tr>
          </thead>
<tbody>

<?php $id=$_GET['id'];
$result = $db->prepare("SELECT * FROM credit_payment WHERE pay_id='$id' AND action='2' ");

    $result->bindParam(':userid', $date);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){





  echo '<tr class="record">';



       ?>


         <td><?php echo $row['id'];   ?> </td>
   <td><?php echo $row['sales_id'];   ?> </td>
  <td><?php echo $row['cus'];   ?> </td>
<td>Rs.<?php echo $row['credit_amount'];   ?></td>
  <td><?php echo $row['pay_amount'];   ?></td>





<td>

<a href="bulk_payment_list_dll.php?id=<?php echo $row['id'];   ?>&pay_id=<?php echo $_GET['id'];   ?>"   title="Click to Delete" >
    <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>


</td>
          </tr>


  <?php }   ?>
  </tbody>

        </table>

<?php } ?>
      </div></div></div>

		</section>
          <!-- /.box -->



    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<script src="js/jquery.js"></script>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
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





 <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this ? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "bulk_payment_list_dll.php?pay_id=<?php echo $_GET['id']; ?>",
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








<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({
      autoclose: true
    });





    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>












</body>
</html>
