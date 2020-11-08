<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR BIZNAZ | Unload</title>
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
$sec = "1000000"; 
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='unloading_view.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> HTJT Holdings.
		  
          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo"); 
	                                                        echo date("Y-m-d__h:ia")  ?></small>
        </h2>
		<h4>
		Sales Report
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
				
				<th>Product </th>
				<th>Load Qty</th>
                 <th>Unload Qty</th>
                  
				 <th>Yard After Qty </th>
                <th>Yard Befor Qty</th>
				
				
				
				</tr>
				
				
				

                </thead>
                <tbody>
				<?php
                include("connect.php");
				
				$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM loading WHERE  transaction_id=$id ");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
$driver=$row['driver'];
$lorry_no=$row['lorry_no'];
$he1=$row['helper1'];
$he2=$row['helper2'];
}			
				
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
	$result = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$id'  ORDER by transaction_id DESC");			
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				
				
				$date=0;
				 $time=0;
				 $term=0;
				 $load_yard=0;
				 $unload_yard=0;
				 
				 
			?>	
              
				<tr> 
                <td><?php echo $row['product_name'];?></td>				 
				
				 <td><?php echo $row['qty'];?></td>
				  <td><?php echo $qty=$row['unload_qty'];?></td>
				 <td><?php echo $yard=$row['yard_before'];?></td>
				 <td><?php echo $yard-$qty;?></td>
				  
				<?php
				}
				   ?></td>
                </tr>               
                </tbody>
                <tfoot>
                </tfoot>				
              </table>
		
		<td> Loading ID: 
			<?php echo $id; ?>
			</td>
			<br>
		
		
		
			  <td> Lorry NO: 
			<?php echo $lorry_no; ?>
			</td>
			<br>
			
			<td> Driver: 
			<?php echo $driver; ?>
			</td>
			<br>
			
			<td> Helper 1: 
			<?php echo $he1; ?>
			</td>
			<br>
			
			
			<td> Helper 2: 
			<?php echo $he2; ?>
			</td>
			<br>
		
		    
            </div>
    <!-- Table row -->
   
    <!-- /.row -->

	
	
	
	
	
	
	
	
	
	
	
	
	
 <!------------------------------------------------------------- /.Sales view------------------------------------------------------------------------------ -->	  
		  
		  <div class="box-header with-border">
          <h3 class="box-title">Lorry Sales Report<span class="pull-right badge bg-muted">Empty</span><span class="pull-right badge bg-yellow">Refill</span></h3>
		   
		  
		   <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				  
                  
                
                  <th colspan="2" ></th>
				   <th colspan="2" >12.5kg</th>
				   <th colspan="2" >5kg</th>
				    <th colspan="2" >37.5kg</th>
					
					<th colspan="2" >2kg</th>
				   <?php
				  $qty=0;
			
				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");				
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];
				
	
			?>
				   <th></th>
				   <?php } ?>
                  
                </tr>
				<tr>
				<th>Invoice</th>
				<th>Customer</th>
				   <th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<th  >E</th>
				    <th  >R</th>
					<?php
				  $qty=0;
				
				
				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");				
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];
				
	
			?>
				   <th><?php echo $row['gen_name']; ?></th>
				   <?php } ?>
					
				<tr>
				
                </thead>
                <tbody>
				<?php
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
				
				$id=$_GET['id'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result2 = $db->prepare("SELECT * FROM sales WHERE loading_id='$id' and action='1'  ORDER by transaction_id DESC");
				
					$result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['invoice_number'];
	
	

				
				
			?>
                <tr>
				
				<td><?php echo $row2['transaction_id'];?></td>
                  <td><?php echo $row2['name'];?></td>
				  
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
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['qty'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-yellow"><?php 			
					
			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['qty'];
				}
			?></span></td>
					<?php } ?>
<?php
				  $ter1=7;
			
				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+9;
				
			?>
				   
				     
				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['qty'];
				}
			?></span></td>

					<?php } ?>
				
				
				
				
				<?php

				}

			
			?>
				</tr>
                
                </tbody>
				
                <tfoot   class=" bg-aqua"   >
                
				<td  colspan="2" >Total</td>

				
 <?php $invo="2520011210105934";
				  $ter=4;			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>				   				     				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id_e' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['sum(qty)'];
				}
			?></span></td>
	<td><span class="pull-right badge bg-green"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['sum(qty)'];
				}
			?></span></td>
					<?php } ?>
<?php
				  $ter1=7;
			
				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+9;
				
			?>
				   
				     
				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE  loading_id='$id' and product_id='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['sum(qty)'];
				}
			?></span></td>

					<?php } ?>
				
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
