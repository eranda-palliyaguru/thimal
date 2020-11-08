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
        INCOME Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">INCOME Elements</li>
      </ol>
    </section>
   
   <br>
   

     <form  method="get">   
	<center>
From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" /> 
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/> 


 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
 
			  
		<br>	  
			  
      
			 
			 </center>
			 </form> 
   
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">INCOME Report  <a href="expenses_sum_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>"   title="Click to Print" >
		<button class="btn btn-danger">Print</button></a></h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
				<h3>REVENUE</h3>
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
					<th></th>
					
					<th>Total</th>
				

                </tr>
                </thead>
<tbody>
			
<?php 
	$d1=$_GET["d1"];
	$d2=$_GET["d2"];
	$result = $db->prepare("SELECT * FROM lorry  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$lorry_id=$row['lorry_id']; 
										

					   ?>

			<tr>
               <td><?php echo $row['lorry_no'];   ?> - Gas Sales </td>
<td><?php $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  action='0' and lorry_id='$lorry_id' and type='1' and date BETWEEN '$d1' and '$d2' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   echo $row1['sum(amount)'];
				}?></td>
	      

                  
                </tr>
	            <tr>
               <td><?php echo $row['lorry_no'];   ?> - New Cylinder Sales </td>
<td><?php $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  action='0' and lorry_id='$lorry_id' and type='2' and date BETWEEN '$d1' and '$d2' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   echo $row1['sum(amount)'];
				}?></td>
	        
                </tr>
	
				 <tr>
               <td><?php echo $row['lorry_no'];   ?> -  Accessory Sales </td>
<td><?php $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  action='0' and lorry_id='$lorry_id' and type='3' and date BETWEEN '$d1' and '$d2' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   echo $row1['sum(amount)'];
				}?></td>
	      
       
                </tr>
	            
	             <tr style="background-color: lightblue">
               
	           <td ><?php echo $row['lorry_no'];   ?> TOTAL</td>
	           <td ><?php $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  action='0' and lorry_id='$lorry_id' and  date BETWEEN '$d1' and '$d2' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   echo $row1['sum(amount)'];
				}?></td>        
                 </tr>
				
				<?php } ?>
				</tbody>
			<tfoot class=" bg-aqua">
			<tr>
               
<td>TOTAL REVENUE</td>
	      
<td>Rs.<?php $result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE  action='0' and   date BETWEEN '$d1' and '$d2' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   echo $tot_sales= $row1['sum(amount)'];
				}?></td>        
                </tr>	  
			</tfoot>	    
              </table>
				
	<?php //-------------------------COST OF SALES------------------// 
		 
		 $o_acc=0;$c_acc=0;

$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='1' and date BETWEEN '$d1' and '$d2' ORDER by id ASC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $o_gas=$row1['value'];
				}
$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='2' and date BETWEEN '$d1' and '$d2' ORDER by id ASC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $o_cylinder=$row1['value'];
				}
$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='3' and date BETWEEN '$d1' and '$d2' ORDER by id ASC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $o_acc=$row1['value'];
				}
		 
		 
$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='1' and date BETWEEN '$d1' and '$d2' ORDER by id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $c_gas=$row1['value'];
				}
$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='2' and date BETWEEN '$d1' and '$d2' ORDER by id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $c_cylinder=$row1['value'];
				}
$result1 = $db->prepare("SELECT * FROM day_records WHERE  type='1' and sub_type='3' and date BETWEEN '$d1' and '$d2' ORDER by id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $c_acc=$row1['value'];
				}

$result1 = $db->prepare("SELECT sum(amount) FROM purchases_item WHERE  type='1' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $p_gas=$row1['sum(amount)'];
				}
$result1 = $db->prepare("SELECT sum(amount) FROM purchases_item WHERE  type='2' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $p_cylinder=$row1['sum(amount)'];
				}
		 
$result1 = $db->prepare("SELECT sum(amount) FROM purchases_item WHERE  type='3' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $p_acc=$row1['sum(amount)'];
				}
		 
?>
		 <h3>COST OF SALES</h3>
	              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>#</th>
			   <th>Opening Stock</th>					
			   <th>Purchase</th>
			   <th>Closing Stock</th>
                </tr>
                </thead>
					  
            <tbody>
		   <tr>
	       <td>Gas</td>
	       <td><?php echo $o_gas; ?></td>
		   <td><?php echo $p_gas; ?></td>
		   <td><?php echo $c_gas; ?></td>
           </tr>
			<tr>
	       <td>Cylinder</td>
	       <td><?php echo $o_cylinder; ?></td>
		   <td><?php echo $p_cylinder; ?></td>
		   <td><?php echo $c_cylinder; ?></td>
           </tr>
			<tr>
	       <td>Accessories</td>
	       <td><?php echo $o_acc; ?></td>
		   <td><?php echo $p_acc; ?></td>
		   <td><?php echo $c_acc; ?></td>
           </tr>
				
		    </tbody>
			<tfoot class=" bg-aqua">
			<tr>
              
<td>TOTAL</td>	      
<td>Rs.<?php echo $total_o=$o_gas+$o_acc+$o_cylinder; ?></td> 
<td>Rs.<?php echo $total_p=$p_gas+$p_acc+$p_cylinder; ?></td>
<td>Rs.<?php echo $total_c=$c_gas+$c_acc+$c_cylinder; ?></td> 
            </tr>	  
			</tfoot>
            </table>

		 
		 <?php $tota=$total_o+$total_p;
				$tota=$tota-$total_c; ?>
		 <h4 style="color: red">GROSS PROFIT- Rs <?php echo $tot_sales-$tota ?></h4>

				
<!---------------------------------- OTHER INCOME ---------------------------------------->	 
		
	              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>OTHER INCOME</th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>
					  
            <tbody>
		   <tr>
	       <td>Incentive Income</td>
	       <td>0.00</td>
           </tr>
			<tr>
	       <td>Accrued Discount Received Income</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Cheque Return Charges Income</td>
	       <td>0.00</td>
           </tr>
				
		    </tbody>
            </table>		 
		
<!---------------------------------- OTHER INCOME ---------------------------------------->	 
		 <h3>OPERATIONAL EXPENCES</h3>
	
	          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>PAYROLL EXPENSES</th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>					  
            <tbody>
<?php  $lorry_id=0;
$result = $db->prepare("SELECT * FROM lorry   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			   $lorry_id=$row['lorry_id'];
				?>				
			<tr>
	       <td><?php echo $row['lorry_no']; ?> Salary Expenses</td>
	       <td><?php 
			   $result1 = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE  type_id='3' and action='0' and lorry_id='$lorry_id' and date BETWEEN '$d1' and '$d2' ORDER by sn DESC limit 0,1  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $p_acc=$row1['sum(amount)'];
				}
			   ?></td>
           </tr>
			<?php } ?>	
		    </tbody>
            </table>
				
<!---------------------------------- OTHER INCOME ---------------------------------------->	 
		 <h3>SELLING AND DISTRIBUTION EXPENSES</h3>
	
	          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>Own Lorries</th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>					  
            <tbody>
	       <tbody>
		   <tr>
	       <td>Fuel for  Vehicles</td>
	       <td>0.00</td>
           </tr>
			<tr>
	       <td>Revenue License & Fitness Charges</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Lease on Lorries Lease Interest</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Repair & Maintenance Chargers on Vehicles </td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Highway Charges</td>
	       <td>0.00</td>
           </tr>
		<tr>
	       <td>RMV Charges</td>
	       <td>0.00</td>
           </tr>
		    </tbody>
				
		    </tbody>
            </table>	
		 
		 
<!---------------------------------- OTHER INCOME ---------------------------------------->	 
		 <h3>ADMINISTRATION EXPENSES</h3>
	
	          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th></th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>					  
            <tbody>

	       <tbody>
		   <tr>
	       <td>Staff Salary Expenses</td>
	       <td>0.00</td>
           </tr>
			<tr>
	       <td>Casual Wages</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Electricity Charges</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Rent & Rates</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Security Chargers</td>
	       <td>0.00</td>
           </tr>
		<tr>
	       <td>Office Equipment Maintenance Charges</td>
	       <td>0.00</td>
           </tr>
		    </tbody>
				
		    </tbody>
            </table>	 
	
	   
	   
<!---------------------------------- OTHER INCOME ---------------------------------------->	 	
	          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>FINANCE EXPENSES</th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>					  
            <tbody>

	       <tbody>
		   <tr>
	       <td>Over - Draft Interest Charges</td>
	       <td>0.00</td>
           </tr>
			<tr>
	       <td>Document Charges</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Cheque Return Charges</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>Cheque Books Charges </td>
	       <td>0.00</td>
           </tr>

		    </tbody>
				
		    </tbody>
            </table>
	   
<!---------------------------------- OTHER INCOME ---------------------------------------->	 
		 <h3>TOTAL FINANCE EXPENCES</h3>
	
	          <table  class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>OTHER EXPENSES</th>
			   <th>#</th>					
			   
			   
                </tr>
                </thead>					  
            <tbody>

	       <tbody>
		   <tr>
	       <td>Sundry Expenses</td>
	       <td>0.00</td>
           </tr>
			<tr>
	       <td>ETF</td>
	       <td>0.00</td>
           </tr>
		   <tr>
	       <td>EPF</td>
	       <td>0.00</td>
           </tr>
		   
		    </tbody>
				
		    </tbody>
            </table>
<?php 
			   $result1 = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE   action='0' and  date BETWEEN '$d1' and '$d2'   ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
			   $tot_ex=$row1['sum(amount)'];
				}
			   ?>	
<h3 style="color: green">TOTAL OVERHEAD EXPENSES - <b style="color: black"><?php echo $tot_ex; ?></b></h3>
<h3 style="color: darkgreen">NET PROFIT FOR THE MONTH -<?php echo $tot_sales-$tota-$tot_ex; ?></h3>
	
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
