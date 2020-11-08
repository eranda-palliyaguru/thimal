<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR BIZNAZ | All Sales</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
include("connect.php");
$sec = "1";
	
$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				//$cus=$_GET['cus'];
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $cus;?>'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> HTJT Holdings (PVT)LTD.
		  
          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo"); 
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
		<h4>
		<?php echo "FROM- ".$_GET['d1']." TO- ".$_GET['d2']; ?>
		<h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    
    <!-- /.row -->
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
				$d1=$_GET['d1'];
			    $d2=$_GET['d2'];
				//$cus=$_GET['cus'];	
	$result2z = $db->prepare("SELECT * FROM customer ");
	
				$result2z->bindParam(':userid', $d2);
                $result2z->execute();
                for($i=0; $row = $result2z->fetch(); $i++){
				$customer_id=$row['customer_id'];	
				
	
	
		
				

		
					
					?>
                <tr>
				<td><?php echo $row['customer_id'];?></td>
				<td><?php echo $row['customer_name'];?></td>
				<td></td>
				<td></td>
                  
				  
 <?php
				  $ter=4;
			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>
				   
				     
				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id_e' and action='0' and cus_id='$customer_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['sum(qty)'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0' and cus_id='$customer_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['sum(qty)'];
				}
			?></span></td>
					<?php } ?>
<?php
				  $ter1=7;
			$tot+=0;
				
				
			?>
				   
				     
				  
		

					
		<td></td>			
		<td></td>
		<td></td>			
		<td></td>	
			<td></td>	
				<?php
		} 
				 

			
			?>
				</tr>
                
                </tbody>
				
                <tfoot   class=" bg-aqua"   >
                
				<td  colspan="3" >Total</td>

			<td></td>	
 <?php $invo="2520011210105934";
				  $ter=4;			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>				   				     				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id_e' and action='0' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['sum(qty)'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  date BETWEEN '$d1' and '$d2' and product_id='$pro_id' and action='0'  ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row1 = $result->fetch(); $i++){	
		 echo $row1['sum(qty)'];
				}
			?></span></td>
					
					<?php } ?>
<?php
				  $ter1=7;
			
				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+9;
				
			?>
				   
				     
				  
				
					

					<?php } ?>
					
			<td></td><td></td>
		<td><span class="pull-right badge bg-muted"><?php echo $tot; ?></span></td>
					
	<td></td><td></td>		
                </tfoot>
              </table>
	  
		 </div> 
        </div>
      
      <!-- /.col -->
    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
