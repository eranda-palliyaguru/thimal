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

$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['lorry_no'];$d2=$_GET['d'];?>;URL='unloading_view2.php?lorry_no=<?php echo $d1;?>&d=<?php echo $d2;?>'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> COLOR BIZNAZ.
		  
          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo"); 
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
		<h4>
		Unloading And Load Report
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
                 <th>Unload Qty</th>
                 <th>Load Qty</th>
                 <th>Yard Befor Qty</th>
				 <th>Yard After Qty </th>
                
				
				
				
				</tr>
                </thead>
                <tbody>
				<?php
include("connect.php");
				date_default_timezone_set("Asia/Colombo");
				$hh=date("Y/m/d");
				$d2=$_GET['lorry_no'];
   $result = $db->prepare("SELECT * FROM loading WHERE  lorry_no='$d2' AND action='load'  ORDER by transaction_id DESC LIMIT 0,1");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$term1=$row['term'];
					//$date11=$row['date'];
  
				}
				
				$d1=$_GET['d'];
				$d2=$_GET['lorry_no'];				
				$result = $db->prepare("SELECT * FROM loading WHERE    lorry_no='$d2' AND  action='unload'  ORDER by transaction_id DESC LIMIT    0, 1");				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					//$term1=$row['term'];
				$term=$row['term'];	
				$date11=$row['date'];
				}
				
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM loading WHERE     lorry_no='$d2' AND term='$term' AND date = '$date11' ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				echo '<tr class="record">';
				
				$date=$row['loading_time'];
				 $time=$row['unloading_time'];
				 $term=$row['term'];
				 $load_yard=$row['load_yard'];
				 $unload_yard=$row['unload_yard'];
				 
				 
			?>	
				
				                  
                  
                 			  
				 
                <td><?php echo $row['product_name'];?></td>				 
				 <td><?php echo $qty=$row['qty'];?></td>
				 <td><?php echo $row['qty_sold'];?></td>
				 
				 <td><?php echo $row['yard_before']-$qty;?></td>
				 <td><?php echo $yard=$row['yard_before'];
				 $rep=$row['rep'];
				 $root=$row['root'];
				 
				 ?></td>
				 
				  
				<?php
				}
				   ?></td>
                </tr>
               
                
                </tbody>
				
                <tfoot>
                
				
				
				
				 
				
				
                </tfoot>
              </table>
			  <td> Loading Yard:
			<?php echo $load_yard; ?>
			</td>
			<br>
			
			<td> Unloading Yard:
			<?php echo $unload_yard; ?>
			</td>
			<br>
			
			<td> Loading Time:
			<?php echo $date; ?>
			</td>
			<br>
			
			
			<td> Unloading Time:
			<?php echo $time; ?>
			</td>
			<br>
            </div>
			<h4>New Loading</h4>
				
				
				
				<table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				  
                  
                  <th>Product</th>
				   <th>Load qty</th>
				   <th>Yard qty</th>
					
					</tr>
                </thead>
		
				 <tbody>	
		  <?php
		  $result = $db->prepare("SELECT * FROM loading WHERE    date = '$d1' AND lorry_no='$d2' AND term='$term1'  ORDER by transaction_id ASC");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
	 
			?><tr>
			
	                        <td><?php echo $row['product_name'];?></td>
						
							<td><?php echo $row['qty'];?></td>
	                        <td><?php echo $row['load_yard_before'];?></td>
					 
	
	 
	
		  
				<?php }?>
					
					</tr>               
                </tbody>				
                <tfoot>
                </tfoot>
              </table>
				
    <!-- Table row -->
   
    <!-- /.row -->

   
   
   
   
   
   
   
   
   
    <!------------------------------------------------------------- /.Sales view------------------------------------------------------------------------------ -->	  
		  
		  <div class="box-header with-border">
          <h3 class="box-title">Lorry Sales Report<span class="pull-right badge bg-muted">Empty</span><span class="pull-right badge bg-yellow">Refill</span></h3>
		   
		  
		   <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				  
                  
                  <th type="text" ></th>
				   <th colspan="2" >12.5kg</th>
				   <th colspan="2" >5kg</th>
				    <th colspan="2" >37.5kg</th>
					
					<th colspan="2" >2kg</th>
				   <?php
				  $qty=0;
				$d1=$_GET['d'];
				$d2=$_GET['lorry_no'];
				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");				
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];
				
	
			?>
				   <th><?php echo $row['gen_name']; ?></th>
				   <?php } ?>
                  
                </tr>
				<tr>
				
				<th>Invoice-Customer</th>
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
				$d1=$_GET['d'];
				$d2=$_GET['lorry_no'];
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
				$d2=$_GET['lorry_no'];
   $result = $db->prepare("SELECT * FROM loading WHERE  lorry_no='$d2' AND action='unload' ORDER by transaction_id DESC LIMIT 0,1");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$date11=$row['date'];
  
				}
				
				
				
		
				
				$d1=$term;
				
				$d2=$_GET['lorry_no'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM sales_order WHERE  term='$d1' AND lorry_no='$d2' AND date BETWEEN '$date11' AND '$hh'   ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d2);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		
				
	
	

				
				
			?>
                <tr>
				
				
                  <td><?php echo $row['invoice'];?> - <?php echo $row['customer'];?></td>
				  
				  
				  
				<td><span class="pull-right badge bg-muted"><?php if($row['12_5kg_cylinders']>0){ echo $row['12_5kg_cylinders'];}?></span></td>
				
				<td><span class="pull-right badge bg-yellow"><?php if($row['12_5kg_gas']>0){ echo $row['12_5kg_gas'];}?></span></td>
			
			
			<td><span class="pull-right badge bg-muted"><?php if($row['5kg_cylinders']>0){ echo $row['5kg_cylinders'];}?></span></td>
				<td><span class="pull-right badge bg-yellow"><?php if($row['5kg_gas']>0){ echo $row['5kg_gas'];}?></span></td>
				
				
				<td><span class="pull-right badge bg-muted"><?php  if($row['37_5kg_cylinders']>0){	 echo $row['37_5kg_cylinders'];}?></span></td>
			
				
				<td><span class="pull-right badge bg-yellow"><?php if($row['37_5kg_gas']>0){ echo $row['37_5kg_gas'];}?></span></td>
			
				
				
				<td><span class="pull-right badge bg-muted"><?php if($row['2kg_cylinders']>0){ echo $row['2kg_cylinders'];}?></span></td>
				<td><span class="pull-right badge bg-yellow"><?php if($row['2kg_gas']>0){ echo $row['2kg_gas'];}?></span></td>
				
				
				<?php

				}

			
			?>
				</tr>
                
                </tbody>
				
                <tfoot   class=" bg-aqua"   >
                
				<td  >Total</td>

				
				<?php

				
				$result1 = $db->prepare("SELECT * FROM products WHERE product_id<='4' ");
				
					$result1->bindParam(':userid', $d1);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
				$crr=$row['tebal_id'];
				$product_id=$row['product_id']+4;
				
				$result2 = $db->prepare("SELECT * FROM products WHERE product_id='$product_id' ");
				
					$result2->bindParam(':userid', $d1);
                $result2->execute();
                for($i=0; $row = $result2->fetch(); $i++){
			$cr=$row['tebal_id'];
				}
				
				
				
				$hh=date("Y/m/d");
				$d1=$term;
				$d2=$_GET['lorry_no'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum($cr) FROM sales_order WHERE  term='$d1' AND lorry_no='$d2'  AND date BETWEEN '$date11' AND '$hh' ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			<td>
				<span class="pull-right badge bg-yellow"><?php echo $row['sum('.$cr.')'];?></span></td>
			<?php

				}

			
			?>
			<?php

			
			
			
			
				
				$d1=$term;
				$d2=$_GET['lorry_no'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT sum($crr) FROM sales_order WHERE  term='$d1' AND lorry_no='$d2' AND date BETWEEN '$date11' AND '$hh'  ORDER by transaction_id DESC");
				
					$result->bindParam(':userid', $d);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
			
			
				<td><span class="pull-right badge bg-"><?php echo $row['sum('.$crr.')'];?></span></td>
			<?php
				}
				}

			
			?>
				
			


				
				
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
