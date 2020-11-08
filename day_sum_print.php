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
		  
          <small class="pull-right">Date:<?php
			  $d1=$_GET['d1'];
				$d2=$_GET['d2'];
			  
			  
			  date_default_timezone_set("Asia/Colombo"); 
	                                                        echo $d1.date("__h:ia")  ?></small>
        </h2>
		<h4>
		Day Report
		<h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    
    <!-- /.row -->

    <!-- Table row -->
   
    <!-- /.row -->

	

<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>				
				<th>Invoice no </th>
				<th>Customer</th>
				<th>Lorry no</th>
				<th>Driver</th>
                 <th>Pay type</th>                  
				 <th>Amount </th>
                <th>Chq no</th>				
				<th>Chq Date</th>
				<th>Bank</th>
				</tr>
                </thead>
                <tbody>
				<?php
               include("connect.php"); 
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
			    $r=$_GET['r'];
				
$result1 = $db->prepare("SELECT * FROM sales WHERE  date BETWEEN '$d1' and '$d2' ");
$result1->bindParam(':userid', $c);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
	
$in=$row1['transaction_id'];
$cus=$row1['name'];
$cashier=$row1['cashier'];
			

	$result = $db->prepare("SELECT * FROM payment WHERE  sales_id='$in'   ORDER by transaction_id DESC");			
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$type=$row['type'];

					
	$result12 = $db->prepare("SELECT * FROM employee WHERE  id = '$cashier' ");
$result12->bindParam(':userid', $c);
$result12->execute();
for($i=0; $row12 = $result12->fetch(); $i++){
$dir=$row12['name'];

}

					
if($type==$r){
				 
				 
			?>	
              
				<tr> 
                <td><?php echo $in;?></td>				 
				
				 <td><?php echo $cus;?></td>
				<td><?php echo $row1['lorry_no'];?></td>
				<td><?php echo $dir;?></td>
				  <td><?php echo $row['type'];?></td>
				 <td><?php echo $row['amount'];?></td>
				 <td><?php echo $row['chq_no'];?></td>
				<td><?php echo $row['chq_date'];?></td>
				<td><?php echo $row['bank'];?></td>
				  
				<?php
				} } }
				   ?></td>
                </tr>               
                </tbody>
                <tfoot>
                </tfoot>				
              </table>
	<?php
	
	$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='cash'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
$cash=$row['sum(amount)'];

}
	
$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='chq'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
$chq=$row['sum(amount)'];

}

	
$result = $db->prepare("SELECT sum(amount) FROM payment WHERE  loading_id='$id' AND type='credit'  ORDER by transaction_id DESC");
$result->bindParam(':userid', $c);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
$credit=$row['sum(amount)'];

}
	?>		  
			  
			  
	  
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
