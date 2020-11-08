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
  
	<style>
th 
{
  vertical-align: bottom;
  text-align: center;
}

th span 
{
  -ms-writing-mode: tb-rl;
  -webkit-writing-mode: vertical-rl;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  white-space: nowrap;
}
		
th h1 
{
  -ms-writing-mode: tb-rl;
  -webkit-writing-mode: vertical-rl;
  writing-mode: vertical-rl;
  transform: rotate(230deg);
  white-space: nowrap;
}
</style>

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
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='stock_rp.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>'">	
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
			Stock
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
				   <?php
				  $qty=0;
			
				$result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");				
				$result1->bindParam(':userid', $d2);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
	            $id=$row['product_id'];
				
	
			?>
				  <th  style="" ><span> <?php echo $row['gen_name']; ?></span></th>
				   <?php } ?>
					
					
                  
                </tr>
				
				<tr>
				<th>ID</th>
				<th>Date</th>
				<th>Lorry no</th>
				<th>Driver</th>
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
				   <th></th>
				
				   <?php } ?>
				
				</tr>
				
                </thead>
                <tbody>
				<?php
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$tot=0;	$tot_f=0;		
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				//$cus_id=$_GET['cus'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];

	$result2 = $db->prepare("SELECT * FROM loading WHERE  date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
	
	$cus=">0";

					

				
					$result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['transaction_id'];
	
	

				
				
			?>
                <tr>
				
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
                  <td><?php echo $row2['lorry_no'];?></td>
					<td><?php 			
				$dri=$row2['driver'];	
			$result = $db->prepare("SELECT * FROM employee WHERE  id='$dri'  ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 	 echo $row['name'];
				}
			?></td>
				  
 <?php
				  $ter=4;
			
				for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
	            $pro_id=$pro_id1+1;
				$pro_id_e=$pro_id1+5;
			?>
				   
				     
				  
				<td><?php 			
					
			$result = $db->prepare("SELECT * FROM loading_list WHERE  loading_id='$invo' and product_code='$pro_id_e' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 	 echo $row['qty']."(".$row['unload_qty'].")";
				}
			?></td>
	<td><?php 			
					
			$result = $db->prepare("SELECT * FROM  loading_list WHERE  loading_id='$invo' and product_code='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			 echo $row['qty']."(".$row['unload_qty'].")";
				}
			?></td>
					<?php } ?>
<?php
				  $ter1=7;
			
				for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {
	            $pro_id=$pro_id2+9;
				
			?>
				   
				     
				  
				<td><?php 			
					
			$result = $db->prepare("SELECT * FROM  loading_list WHERE  loading_id='$invo' and product_code='$pro_id' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		  echo $row['qty']." (".$row['unload_qty'].")";
				}
			?></td>

					<?php } ?>
			<td></td><td></td>		
		<?php 			
	
		 $type= 0;
		$ch_date=0;
			
			?>			
		
				
				
				
				
				</tr>
					

    <?php
$tot+=$row2['driver'];
$tot_f+=$row2['driver'];

				}
			?>            
                </tbody>
				

              </table>  
	<br><br> <center>
	<h4>............... <br> Stock keeper</h4></center>
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
