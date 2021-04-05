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





    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"><div class="row">

  <div class="col-lg-3 col-xs-6">
      <h1>
       Cash Book
        <small>Preview</small>
      </h1>  </div>



            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Rs.<?php     $resultz = $db->prepare("SELECT * FROM peti WHERE id='1' ");
                      $resultz->bindParam(':userid', $inva);
                      $resultz->execute();
                      for($i=0; $rowz = $resultz->fetch(); $i++){
                      echo  $rowz['amount'];
                      } ?></h3>

                  <p>MAIN CASH </p>
                </div>
                <div class="icon">
                  <i class="ion ion-group"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>


                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Rs.<?php     $resultz = $db->prepare("SELECT * FROM peti WHERE id='2' ");
                          $resultz->bindParam(':userid', $inva);
                          $resultz->execute();
                          for($i=0; $rowz = $resultz->fetch(); $i++){
                          echo  $rowz['amount'];
                          } ?></h3>

                      <p>PETTY CASH</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-group"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
  </div>
    </section>


    <!-- Main content -->
    <div class="row">


    <div class="col-lg-6 col-xs-6">
  		<div class="box">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cash TOPUP</h3>


        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="petty_topup_save.php">
			<input type="hidden" value='' id="datepicker" name="source"  >
			<input type="hidden" value='' id="datepicker" name="chq_no"  >
        <div class="box-body">



          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Type</label>
  <select class="form-control " name="type" style="width: 100%;" id="p_type" onchange="view_payment_date(this.value);" autofocus tabindex="1" >
	                <option></option>
                    <option>Chq</option>
					<option>Cash</option>
                </select>
				</div>
              </div>



            <div class="col-md-6">
              <div class="form-group">
				   <label>	Amount</label>
                <input type="text" value='' name="amount" class="form-control pull-right" tabindex="2" >
                </div>
				</div>
			</div>


			  <div class="row">

                        <div class="col-md-6">
                              <div class="form-group" >
                                <label>Date</label>
                <input type="text" class="form-control pull-right" value='<?php  echo date("Y-m-d"); ?>' id="datepicker" name="date"  >
                        </div>
                              </div>

              <div class="col-md-6" id='chq_no' style="display:none;">
              <div class="form-group" >
               <label>Chq No.</label>
                <input type="text" value=''  name="chq_no" class="form-control pull-right" tabindex="3">
                  </div>
				</div>

				<div class="col-md-6" id='source' style="display:none;">
              <div class="form-group" >
                <label>Source</label>
              <select class="form-control select2" name="source" style="width: 100%;" autofocus >
				  <?php
    $result = $db->prepare("SELECT * FROM loading WHERE bank_action='0' and action='unload' and cash_total>'0'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
<option value="<?php echo $row['transaction_id'];?>"><?php echo $row['lorry_no']."__".$row['date']."__Rs.".$row['cash_total']; ?>    </option>
	<?php
				}
			?>
                </select>
				</div>
              </div>


				</div>



			  <div class="form-group">




        </div>
      </div>


      <!-- /.box -->
<div class="form-group">





			  <input class="btn btn-info" type="submit" value="Submit" >

			  </form>


			  <div class="cctv">

			  </div>

			  </div></div></div></div></div></div>




            <div class="col-lg-6 col-xs-6">
          		<div class="box">

              <!-- SELECT2 EXAMPLE -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Transfer</h3>


                <!-- /.box-header -->
        		<div class="form-group">

        		<form method="post" action="petty_transfer.php">
        			<input type="hidden" value='' id="datepicker" name="source"  >
        			<input type="hidden" value='' id="datepicker" name="chq_no"  >
                <div class="box-body">



                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>FROM</label>
          <select class="form-control " name="from" style="width: 100%;" autofocus tabindex="1" >

                            <option value="1">main</option>
        					<option value="2">petty</option>
                        </select>
        				</div>
                      </div>


                      <div class="col-md-6">
                      <div class="form-group" >
                       <label>TO</label>
         <select class="form-control " name="to" style="width: 100%;" autofocus tabindex="1" >
              <option value="2">petty</option>
              <option value="1">main</option>
                       </select>
                          </div>
        				</div>

        			</div>


        			  <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
               <label>	Amount</label>
                    <input type="text" value='' name="amount" class="form-control pull-right" tabindex="2" >
                    </div>
            </div>

        				<div class="col-md-6">
                      <div class="form-group" >
                        <label>Date</label>
  <input type="text" class="form-control pull-right" value='<?php  echo date("Y-m-d"); ?>' id="datepicker" name="date"  >
        				</div>
                      </div>
        				</div>
        			  <div class="form-group">




                </div>
              </div>


              <!-- /.box -->
        <div class="form-group">





        			  <input class="btn btn-info" type="submit" value="Submit" >

        			  </form>


        			  <div class="cctv">

        			  </div>

        			  </div></div></div></div></div></div>

      </div>


          <!-- /.box -->

		 <section class="content">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Collection List</h3>
            </div>
            <div class="box-body">





			 <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>ID</th>
					<th>Date</th>
				<th>Type</th>
				<th>Amount (Rs.)</th>
                  <th>Chq No.</th>
					<th>Cash Source id</th>
				<th>Balance</th>



                  <th>#</th>

                </tr>
                </thead>
<tbody>

<?php $result = $db->prepare("SELECT * FROM expenses_records WHERE action='0' and m_type='1'");

					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){





				echo '<tr class="record">';

					$so=$row['sn'];

					   ?>


               <td><?php echo $row['sn'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
   <td><?php echo $row['chq_no'];   ?> </td>
	<td><?php if($so>0){ ?><a href="loading_view.php?id=<?php echo $row['loading_id'];   ?>"><?php echo $row['loading_id'];   ?></a><?php } ?></td>
    <td><?php echo $row['balance'];   ?> </td>




<td>

<a href="#" id="<?php echo $row['sn']; ?>" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>


</td>
                </tr>


				<?php }   ?>
				</tbody>

              </table>
            </div>



            </div>
            <!-- /.box-body -->
          </div>


</div>


        </div>
        <!-- /.col (left) -->



            <!-- /.box-body -->

            </div>
          </div>

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
 if(confirm("Sure you want to delete this Collection? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "petty_dll.php",
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

    //Date picker
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({
      autoclose: true
    });



  });



 function view_payment_date(type){
	if(type=='Cash'){
	document.getElementById('source').style.display='block';
	document.getElementById('chq_no').style.display='none';
		} else if(type=='Chq'){
		document.getElementById('chq_no').style.display='block';
		document.getElementById('source').style.display='none';
			}else {
		document.getElementById('chq_no').style.display='none';
		document.getElementById('source').style.display='none';
			}
	 }
</script>

</body>
</html>
