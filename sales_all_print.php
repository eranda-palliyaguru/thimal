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

$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_all_rp.php?d1=<?php echo $d1;?>'">	
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
				  <th>Product Name</th>

                 				   
			      <th>Total Sales</th>
				<th>Total Sales Amount</th>
				  <th>Total Margin</th>

					
				   
                  
                </tr>
                </thead>
                <tbody>
				<?php
   $tot_tot_margin=0;
   $tot_amount=0;
  
			
				include("connect.php");
				
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
				
				$price=$row['price'];
				$o_price=$row['o_price'];
					
				$margin=$price-$o_price;
					
				$qty_total=$qty1+$qty2;

				
				
			?>
                <tr>
				
				
                  <td><?php echo $row['gen_name'];?></td>

<td><?php
					
				$result1 = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$p_qty=$row['sum(qty)'];
					echo $row['sum(qty)'];
					}
				  ?></td>					
					
<td><?php
					
				$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND action='0' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$amount=$row['sum(amount)'];
					
					echo "Rs.".number_format( $row['sum(amount)'],2 );
					} 
					
					$tot_margin=$margin*$p_qty
				  ?></td>				
				 
				<td><?php echo "Rs.".number_format($tot_margin,2);?></td>
					
					
							
					
					
					
					
				 
				 
				 <?php
					$tot_amount+=$amount;
					
					$tot_tot_margin+=$tot_margin;
					
				}	
                 			?>
				</tr>
                
                </tbody>
			<tfoot>	
            <tr style="background-color: grey; color: white">
			<td></td>
			
			<td></td>
			<td>Rs.<?php echo number_format( $tot_amount,2);?></td>	
			<td>Rs.<?php echo number_format( $tot_tot_margin,2);?></td>
		
			</tr>	
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
