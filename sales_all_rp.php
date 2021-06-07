
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
          $d1=$_GET['d1'];
          $d2=$_GET['d2'];
      		$total=0;
      		//$invo=$_GET['id'];
$or_d1=$d1;
$margin_total=0;
          $result1 = $db->prepare("SELECT * FROM products  ORDER by product_id ASC");
  				$result1->bindParam(':userid', $d2);
          $result1->execute();
          for($i=0; $row1 = $result1->fetch(); $i++){
          $tebal_id=$row1['product_id'];
          $price=$row1['price'];
          $price2=$row1['price2'];
          $price_o=$row1['o_price'];
        //  $area=$row1['area'];
        $dealer="";$dealer1=""; $dealer_qty="";$dealer_qty1=""; $sell="";$sell_val="";  $dis="";$dis_val=""; $sell_m="";$dis_m="";$dis_m1=""; $dealer_m="";  $dealer_m1=""; $sell_v1="";

                  $result1122 = $db->prepare("SELECT * FROM price_update WHERE product_id='$tebal_id'  ORDER BY id ASC ");
                  $result1122->bindParam(':userid', $invo);
                  $result1122->execute();
                  for($i=0; $row1122 = $result1122->fetch(); $i++){

include("sales_all_rp_price_update.php");

              }

?>
<tr>
       <td style="background-color:#aba272"><?php echo $row1['gen_name']; ?></td>

  <!------------------------------------------------------------------------------ Kaluthara ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer_qty_s=$row['sum(qty)'];}

            echo $dealer_qty+$dealer_qty_s;

       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){  $dealer_s  = $row['sum(amount)'];  }
         echo number_format($dealer+$dealer_s,2);

           $dma=$dealer_s-($price_o*$dealer_qty_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php     echo number_format($dealer_m=$dma+$dealer_m,2);   ?></td>

  <!------------------------------------------------------------------------------ Colombo ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer_qty1_s=$row['sum(qty)'];}
        echo  $dealer_qty1+$dealer_qty1_s;



       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'   AND  price = '$price' AND price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){  $dealer1_s= $row['sum(amount)']; }
        echo $dealer1+$dealer1_s;


        $dma1=$dealer1_s-($price_o*$dealer_qty1_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php  echo number_format($dealer_m1=$dma1+$dealer_m1,2);  ?></td>



  <!------------------------------------------------------------------------------ Selling ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell_s=$row['sum(qty)'];}
            echo $sell+$sell_s;
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell_val_s=$row['sum(amount)']; }
            echo number_format($sell_val+$sell_val_s,2);

            $sell_ma=$sell_val_s-($price_o*$sell_s)
       ?></td>

       <td style="background-color:#bfa106"> <?php  echo number_format($sell_m=$sell_m+$sell_ma,2);   ?></td>


  <!------------------------------------------------------------------------------------ Discount ------------------------------------------------------------------------------------->

       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis_s=$row['sum(qty)'];}
            echo $dis=$dis+$dis_s;
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis_val_s=$row['sum(amount)'];}
            echo number_format($dis_val+$dis_val_s,2);

            $dis_ma=($price-$price_o)*$dis_s;
            $ma11=$dis_val_s-($price*$dis_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php    echo number_format($dis_ma=$dis_ma+$dis_m1,2);   ?>(<?php   echo $ma11+$dis_m;   ?>)</td>

  <!-------------------------------------------------------------------------------------------- Total ------------------------------------------------------------------------------------>

       <td style="background-color:rgba(191,161,6,0.42)">
         <?php 				$d1=$_GET['d1'];
         				$d2=$_GET['d2'];
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
         for($i=0; $row = $result->fetch(); $i++){ $total+=$row['sum(amount)'];
            echo number_format($row['sum(amount)'],2); }
       ?></td>

       <td style="background-color:#bfa106"> <?php $margin_total+=$dealer_m+$dealer_m1+$sell_m+$dis_ma;   echo number_format($dealer_m+$dealer_m1+$sell_m+$dis_ma,2); // Margin total  ?></td>



      				 </tr>

      				 <?php
      			 }?>
             <tr>

               <td colspan="14"style="background-color:#aba272"><center>Total</center> </td>
               <td style="background-color:#aba272"> Rs.<?php   echo number_format($total,2); // Sales Value total  ?></td>
               <td style="background-color:#aba272"> Rs.<?php   echo number_format($margin_total,2); // Margin total  ?></td>
             </tr>
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
