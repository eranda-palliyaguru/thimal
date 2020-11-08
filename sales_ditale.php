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
			      <th>Total Sales (QTY)</th>
				<th>Total Sales Amount</th>
				  <th>Total Margin</th>
				<th colspan="2">Cash Total</th>
				<th colspan="2">Chq Total</th>
				<th colspan="2">credit Total</th>
				   
                  
                </tr>
                </thead>
                <tbody>
				<?php
   $tot_tot_margin=0;
   $tot_amount=0;
$cash_a=0;
					$chq_a=0;
					$credit_a=0;
  include("connect.php");
			
				
				
				date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
				 
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM products WHERE product_id<'5' ORDER by product_id ASC");
				
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
					
				$result1 = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' and sr='1' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$p_qty=$row['sum(qty)'];
					echo $row['sum(qty)'];
					}
				  ?></td>					
					
<td><?php
					
				$result1 = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' and sr='1' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$amount=$row['sum(amount)'];
					
					echo "Rs.".number_format( $row['sum(amount)'],2 );
					} 
					
					$tot_margin=$margin*$p_qty
				  ?></td>				
				 
				<td><?php echo "Rs.".number_format($tot_margin,2);?></td>
					
	<td><?php
				$cash_tot=0;	
				$result1 = $db->prepare("SELECT * FROM sales_list WHERE product_id='$tebal_id' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$invo=$row['invoice_no'];
				    $cash_amount=$row['amount'];
					
					
					$trid="";
					$result11 = $db->prepare("SELECT * FROM payment WHERE invoice_no='$invo' AND  type='cash' and amount>'100'");			
				$result11->bindParam(':userid', $d);
                $result11->execute();
                for($i=0; $row1 = $result11->fetch(); $i++){
					$trid=$row1['transaction_id'];	
				}
					
					if($trid>1){ $cash_tot+=$cash_amount; }
					} 
					
					echo "Rs.".number_format( $cash_tot,2 );
				  ?></td>
					<td><?php
$cash_b=$amount-$cash_tot;					
$h31=$amount/100;
$h411=$cash_b/$h31;
$cashp=100-$h411;
					echo number_format( $cashp,2 ),"%";
					?></td>
							
		<td><?php
				$chq_tot="";	
				$result1 = $db->prepare("SELECT * FROM sales_list WHERE product_id='$tebal_id' and sr='1' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$invo=$row['invoice_no'];
				    $chq_amount=$row['amount'];
					
					
					$trid="";
					$result11 = $db->prepare("SELECT * FROM payment WHERE invoice_no='$invo' AND  type='chq' and amount>'100'");			
				$result11->bindParam(':userid', $d);
                $result11->execute();
                for($i=0; $row1 = $result11->fetch(); $i++){
					$trid=$row1['transaction_id'];	
				}
					
					if($trid>1){ $chq_tot+=$chq_amount; }
					} 
					
					echo "Rs.".number_format( $chq_tot,2 );

				  ?></td>
					<td><?php
$chq_b=$amount-$chq_tot;					
$h32=$amount/100;
$h412=$chq_b/$h32;
$chqp=100-$h412;
					echo number_format( $chqp,2 ),"%";
					?></td>
					
					
			<td><?php
				$credit_tot=0;	
				$result1 = $db->prepare("SELECT * FROM sales_list WHERE product_id='$tebal_id' and sr='1' AND date BETWEEN '$d1' and '$d2' ");			
				$result1->bindParam(':userid', $d);
                $result1->execute();
                for($i=0; $row = $result1->fetch(); $i++){
					$invo=$row['invoice_no'];
				    $credit_amount=$row['amount'];
					
					
					$trid3="";
					$result11 = $db->prepare("SELECT * FROM payment WHERE invoice_no='$invo' AND  type='credit' and amount>'100'");			
				$result11->bindParam(':userid', $d);
                $result11->execute();
                for($i=0; $row1 = $result11->fetch(); $i++){
					$trid3=$row1['transaction_id'];	
				}
					
					if($trid3>2){ $credit_tot+=$credit_amount; }
					} 
					
					echo "Rs.".number_format( $credit_tot,2 );
				  ?></td>		
			<td><?php
$cr_b=$amount-$credit_tot;					
$h33=$amount/100;
$h413=$cr_b/$h33;
$crp=100-$h413;
					echo number_format( $crp,2 ),"%";
					?></td>
					
					
					
				 
				 
				 <?php
					$tot_amount+=$amount;
					
					$tot_tot_margin+=$tot_margin;
					$cash_a+=$cash_tot;
					$chq_a+=$chq_tot;
					$credit_a+=$credit_tot;
					
				}	
                 			?>
				</tr>
                
                </tbody>
			<tfoot>	
            <tr style="background-color: grey; color: white">
			<td></td>
			
			<td>Total</td>
			<td>Rs.<?php echo number_format( $tot_amount,2);?></td>	
			<td>Rs.<?php echo number_format( $tot_tot_margin,2);?></td>
			<td colspan="2">Rs.<?php echo number_format( $cash_a,2);?></td>
			<td colspan="2">Rs.<?php echo number_format( $chq_a,2);?></td>
			<td colspan="2">Rs.<?php echo number_format( $credit_a,2);?></td>
		
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
