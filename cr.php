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
        Sales Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   <br>
   

     <form action="sales_credit.php" method="get">   
	<center>
	
			  
			  
			

Day Limit :<input type="text" style="width:223px; padding:4px;" name="r"  value="" autocomplete="off" /> 

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
              <h3 class="box-title">Sales Report  <a href="sales_credit_print.php?r=<?php echo $_GET['r'] ?>&cus=<?php echo $_GET['cus'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
	       <table id="example1" class="table table-bordered table-striped">
                <thead>				
                <tr>
                  <th colspan="4" ></th>
				   <th colspan="2" >12.5kg</th>
				   <th colspan="2" >5kg</th>
				    <th colspan="2" >37.5kg</th>					
					<th colspan="2" >2kg</th>
				    <th colspan="5" >#</th>
                </tr>
				
				<tr>
				<th>Cus_id</th>
				<th>Customer</th>
				<th>Invoice</th>
				<th>Date</th>
				
				   <th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
				
				<th>Type</th>
				<th>Amount</th>
				<th>Due</th>
				<th>Phone no</th>
				<th>#</th>
				</tr>
				</thead>
                
                <tbody>
				<?php 
					$tot=0;
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$pay_type="";		
			
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$cus=$_GET['cus'];	
	if($cus=="all"){$result2z = $db->prepare("SELECT * FROM payment WHERE action='2' AND type='credit' and pay_credit='0' ORDER BY customer_id ASC");
			}else{$result2z = $db->prepare("SELECT * FROM payment WHERE action='2' and type='credit' and customer_id='$cus'");}
	
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
				
		
		    $date1=$row2['date'];
			$date =  date("Y-m-d");
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);			
		
			$coo=$_GET['r'];				
					
				
				
		if($rs1 >= $coo){
		$color="";$color1="";
		if($rs1>=25){$color="yellow"; $color1="black";}
		if($rs1>=40){$color="red"; $color1="white";}
		
					
					?>
                <tr style="background-color: <?php echo $color; ?>; color: <?php echo $color1; ?>">
				<td><?php echo $row['transaction_id'];?></td>
				<td><?php echo $row2['name'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
                  
				  
 <?php
				  $ter=4;
			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>
				   
				     
				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['qty'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php 			
					
			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['qty'];
				}
			?></span></td>
					<?php } ?>
<?php
				  $ter1=7;
			$tot+=$row2['amount'];
				
				
			?>
				   
				     
				  
		

					
					
		
		<td><?php	echo $row['type'];	?></td>			
		<td><?php echo $row['amount'];?></td>		
		<td><?php	echo $rs1;	?></td>		
			<td><?php $cus_id=$row2['customer_id'];
			$result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$cus_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['acc_no']." - ".$row['acc_name'];
				}
			?></td>	
			<td><?php if($r =='admin'){?><a rel="facebox" href="payment_view_view.php?id=<?php echo $row2['transaction_id'];?>"   title="Click to pay" >
				  <button class="btn btn-primary">Set Payment</button></a><?php } ?></td>	
				<?php
		} } 
				} 

			
			?>
				</tr>
                
                </tbody>
				
                <tfoot   class=" bg-aqua"   >
                
				<td  colspan="3" >Total</td>

				
 <?php $invo="2520011210105934";
				  $ter=4;			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>				   				     				  
				<td></td>
	<td></td>
					
					<?php } ?>
<?php
				  $ter1=7;
			
				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+9;
				
			?>
				   
				     
				  
				
					

					<?php } ?>
					
			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php echo $tot; ?></span></td>
					
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
