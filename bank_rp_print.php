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
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='bank_rp.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>'">	
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
					<th>ID</th>
					<th>#</th>
					<th>Date</th>
				<th>Type</th>
				<th>Amount (CREDIT)</th>
				<th>Amount (DEBIT)</th>
				<th>CHQ no/Loading id</th>
                  <th>Comment</th>
					<th>Balance</th>

                </tr>
                </thead>
<tbody>
			
<?php 
	$d1=$_GET["d1"];
	$d2=$_GET["d2"];
	$result = $db->prepare("SELECT * FROM bank WHERE  action='0' and date BETWEEN '$d1' and '$d2' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
				  
				 
					$m_type=$row['type']; 
					
					if($m_type>"2"){echo '<tr style="background-color: lightgray;" >';
					}else{echo '<tr>';}
					   ?>

			
               <td ><?php echo $row['id'];   ?> </td>
	       <td ><?php if($row['type']<"3"){  ?><span class="pull-right badge bg-green" >CREDIT</spa> <?php } ?>
	          <?php if($row['type']>"2"){  ?><span class="pull-right badge bg-red" >DEBIT</spa> <?php } ?>
			   <?php if($row['type']=="3"){  ?><span class="pull-left badge bg-blue" >Lorry</span><span class="pull-right badge bg-red" >DEBIT</span> <?php } ?>
	</td>
	
	       <td><?php echo $row['date'];   ?> </td>
		<td>
<?php if($row['type']=="2"){  ?><span class="pull-right badge bg-green" >CASH</span><?php } ?>
<?php if($row['type']=="1"){  ?><span class="pull-right badge bg-yellow" >CHQ</span> <?php } ?>
<?php if($row['type']=="4"){  ?><span class="pull-right badge bg-red" >BANK TRANSFER</span> <?php } ?>
<?php if($row['type']=="5"){  ?><span class="pull-right badge bg-yellow" >CHQ</span> <?php } ?></td>
	
	
	<td><?php if($row['type']<"3"){ echo "Rs.".$row['amount']; } ?></td>
	<td><?php if($row['type']>"2"){ echo "Rs.".$row['amount']; } if($row['type']=="3"){ echo "Rs.".$row['amount']; } ?></td>
	<td><?php echo $row['chq_no'];   ?></td>
				<td><?php echo $row['bank'];   ?></td>
   <td><?php echo $row['balance']; ?></td>
                  
                </tr>
				
				
				<?php } ?>
				</tbody>
                
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
