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
				$cus=$_GET['cus'];
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_rp_special.php?d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&cus=<?php echo $cus;?>'">	
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
				<th>Customer id</th>
				<th>Invoice</th>
				<th>Date</th>
				<th>Customer</th>
				   <th  >37.5 gas</th>
				    <th>SP Price</th>
				<th>Fix Price</th>
				<th>Different</th>
				<th>Reim Amount</th>
				<th>#</th>
				</tr>
				
                </thead>
                <tbody>
				<?php
	    date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$tot=0;	$tot_d=0;		
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$cus_id=$_GET['cus'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
					
$view = $db->prepare("SELECT * FROM customer WHERE  s_price='1' ORDER by customer_id ASC");				
				$view->bindParam(':userid', $d2);
                $view->execute();
                for($i=0; $row5 = $view->fetch(); $i++){
	            $cccus=$row5['customer_id'];
									
					
if($cus_id=="all"){
	$result2 = $db->prepare("SELECT * FROM sales WHERE customer_id='$cccus' and  action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
	
	$cus=">0";
}else{
	$result2 = $db->prepare("SELECT * FROM sales WHERE  customer_id='$cus_id' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
	$cus="=".$cus_id;
}
					

				
				$result2->bindParam(':userid', $d2);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
				$invo=$row2['invoice_number'];
	
$sid=0;	
$view1 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' and price < '5945' ");
				$view1->bindParam(':userid', $d2);
                $view1->execute();
                for($i=0; $row51 = $view1->fetch(); $i++){
	            $sid=$row51['id'];
				}
			if($sid > 1){	
			?>
                <tr>
				<td><?php echo $row2['customer_id'];?></td>
				<td><?php echo $row2['transaction_id'];?></td>
				<td><?php echo $row2['date'];?></td>
                  <td><?php echo $row2['name'];?></td>
				   
				     
				  
				<td><span class="pull-right badge bg-muted"><?php 			
					
			$result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='3' ");
				
					$result->bindParam(':userid', $d1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
		 echo $row['qty'];
			$qqty=$row['qty'];
			$price=$row['price'];
			$amount=$row['amount'];
				}
			?></span></td>
	
			<td><?php echo $price; ?></td>	
      <td>5945.00</td>
<td><?php echo 5945-$price; ?></td>				
		
					
					
		<td><?php 
			$fre=$qqty*5945;	
			echo $fre-$amount; ?></td>		
		<td></td>		
				
				
				<?php
$tot_d+=$qqty;
$tot+=$fre-$amount;

				}
				}
				}
			?>
				</tr>
                
                </tbody>
				
              <tfoot   class=" bg-aqua"   >
                
				<td  colspan="4" >Total</td>


					
			<td><span class="pull-right badge bg-muted"><?php 	echo $tot_d;	?></span></td>
				  <td></td><td></td>
		<td></td>
					
	<td><span class="pull-right badge bg-muted"><?php echo $tot;	?></span></td>	
	<td></td>				 
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
