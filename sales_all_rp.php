
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


$cus_res = $db->prepare("SELECT * FROM customer WHERE area = '2'  ");
          $cus_res->bindParam(':userid', $d2);
                $cus_res->execute();
                for($i=0; $cus_row = $cus_res->fetch(); $i++){
                  $cus_type=$cus_row['area'];
                  $cus_id=$cus_row['customer_id'];

                  $sql = "UPDATE sales_list
                          SET area=?
                  		WHERE cus_id=?";
                  $q = $db->prepare($sql);
                  $q->execute(array($cus_type,$cus_id));




                }

?>









    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Sales Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">All Sales Report</li>
      </ol>
    </section>

	<br>

<a href="sales_all_print.php?d1=<?php echo $_GET['d1'];?>&d2=<?php echo $_GET['d2'];?>"><button  class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
  Print
 </button></a>
      <!-- SELECT2 EXAMPLE -->
	        <form action="sales_all_rp.php" method="get">
	<center>



			<strong>
From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" />
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>


 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>

</strong>

		<br>



			 </center>
			 </form>




    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>





            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
				  <th>Product Name</th>


          <th>Kaluthara Sales</th>
          <th>Colombo Sales</th>
          <th> Total Sales</th>

          <th>Kaluthara value</th>
          <th>Colombo value</th>
          <th> Total value</th>

				  <th>Kaluthara Margin</th>
          <th>Colombo  Margin</th>
          <th>Total Margin</th>




                </tr>
                </thead>
                <tbody>
				<?php
   $tot_tot_margin=0;
   $tot_amount=0;




				date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");

				$d1=$_GET['d1'];
				$d2=$_GET['d2'];

				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM products  ORDER by product_id ASC");

					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$tebal_id=$row['product_id'];
	            $id=$row['product_id'];
	            $qty1=$row['qty'];
				$qty2=$row['qty2'];
        $price1=$row['price2'];
				$price=$row['price'];
				$o_price=$row['o_price'];

				$margin=$price-$o_price;
        $margin2=$price1-$o_price;

				$qty_total=$qty1+$qty2;
$p_qty1=0;$amount1=0;$amount2=0;
$p_qty=0;


			?>
                <tr>


                  <td><?php echo $row['gen_name'];?></td>


    <?php
      $result1 = $db->prepare("SELECT sum(qty) FROM sales_list WHERE area='2' AND product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");
      $result1->bindParam(':userid', $d);
      $result1->execute();
      for($i=0; $row = $result1->fetch(); $i++){
      $p_qty1+=$row['sum(qty)'];}

          	$result1 = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");
          	$result1->bindParam(':userid', $d);
            $result1->execute();
            for($i=0; $row = $result1->fetch(); $i++){
        		$p_qty+=$row['sum(qty)'];
            }

            $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE area='2' AND product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result1->bindParam(':userid', $d);
                    $result1->execute();
                    for($i=0; $row = $result1->fetch(); $i++){
              $amount1+=$row['sum(amount)'];}

              $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");
              $result1->bindParam(':userid', $d);
                      $result1->execute();
                      for($i=0; $row = $result1->fetch(); $i++){
                $amount2+=$row['sum(amount)'];}



                       ?>

<td><?php echo  $p_qty1; ?></td>
<td><?php echo  $p_qty2=$p_qty-$p_qty1; ?></td>
<td style="background-color:#c98585"><?php echo $p_qty; ?></td>


<td><?php echo "Rs.".number_format( $amount1,2 ); ?></td>
<td><?php echo "Rs.".number_format( $amount2-$amount1,2 ); ?></td>
<td style="background-color:#c98585"><?php

		echo "Rs.".number_format( $amount2,2 );
$am=$amount2-$amount1;
					$tot_margin=$o_price*$p_qty2;
          	$tot_margin1=$o_price*$p_qty1;

            $tot_margin3=$o_price*$p_qty;

           $tot_margin=$amount2-$amount1-$tot_margin;
              $tot_margin1=$amount1-$tot_margin1;

              $tot_margin3=$amount2-$tot_margin3;
				  ?></td>

        <td><?php echo "Rs.".number_format($tot_margin1,2);?></td>
        <td><?php echo "Rs.".number_format($tot_margin,2);?></td>
        <td style="background-color:#c98585"><?php echo "Rs.".number_format($tot_margin3,2);?></td>
				 <?php
					$tot_amount+=$amount1;

					$tot_tot_margin+=$tot_margin+$tot_margin1;

				}
                 			?>
				</tr>

                </tbody>
			<tfoot>
            <tr style="background-color: grey; color: white">
			<td colspan="4"></td>
<td></td>
			<td></td>
			<td>Rs.<?php echo number_format( $tot_amount,2);?></td>
      <td colspan="2"></td>
			<td>Rs.<?php echo number_format( $tot_tot_margin,2);?></td>

			</tr>
                </tfoot>
              </table>
            </div>

			<center>



			<td>

			</td>
			</center>



      	<table id="example2" class="table table-bordered table-hover">
      			<tr >
              <th style="background-color:#aba272"></th>
      				<th colspan="3" style="background-color:#aba272"><center>Dealer Kaluthara</center></th>
              <th colspan="3"style="background-color:#aba272" ><center>Dealer Colombo</center></th>
              <th colspan="3"style="background-color:#aba272"><center>Selling</center></th>
      				<th colspan="3"style="background-color:#aba272"><center>Discount</center></th>
              <th colspan="3"style="background-color:#aba272"><center>Total</center> </th>
                   </tr>

                    <tr>
                      <th style="background-color:#aba272">Product Name</th>
                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                            </tr>
      		<?php
      		$total=0;
      		//$invo=$_GET['id'];


          $result1 = $db->prepare("SELECT * FROM products  WHERE product_id < '5' ORDER by product_id ASC");
  				$result1->bindParam(':userid', $d2);
          $result1->execute();
          for($i=0; $row1 = $result1->fetch(); $i++){
          $tebal_id=$row1['product_id'];
          $price=$row1['price'];
          $price2=$row1['price2'];
          $price_o=$row1['o_price'];
?>
<tr>
       <td style="background-color:#aba272"><?php echo $row1['gen_name']; ?></td>

       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){
            echo $row['sum(amount)']; }
       ?></td>

       <td style="background-color:#bfa106"> <?php   $ma=$price2-$price_o;  echo $dma=$ma*$dealer;   ?></td>


       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer1=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){
            echo $row['sum(amount)']; }
       ?></td>

       <td style="background-color:#bfa106"> <?php   $ma=$price-$price_o;  echo $dma1=$ma*$dealer1;   ?></td>




       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell_val=$row['sum(amount)'];
            echo $row['sum(amount)']; }
       ?></td>

       <td style="background-color:#bfa106"> <?php   $ma=$price_o*$sell;  echo $sell_ma=$sell_val-$ma;   ?></td>




       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND  price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dist=$row['sum(amount)'];
            echo $row['sum(amount)']; }
       ?></td>

       <td style="background-color:#bfa106"> <?php   $ma=$price-$price_o;  echo $dis_ma=$ma*$dis;   ?>(<?php   $ma11=$price_o*$dis;  echo $ma11-$dist;   ?>)</td>


       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND    action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis1=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'  AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $to=$row['sum(amount)'];
            echo $row['sum(amount)']; }
       ?></td>

       <td style="background-color:#bfa106"> <?php   echo $dma+$dma1+$sell_ma+$dis_ma;   ?></td>



      				 </tr>
      				 <?php
      			 }?>
      			 </table>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>




    <!-- Main content -->

      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>






<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- FastClick -->




<script src="js/jquery.js"></script>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../../plugins/chartjs/Chart.min.js"></script>
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
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY-MM-DD", {"placeholder": "YYYY-MM-DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY-MM-DD", {"placeholder": "YYYY-MM-DD"});
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
   url: "pay_dll.php",
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
  });
</script>

</body>
</html>
