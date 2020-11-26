<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");

	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
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
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
<?php
$sec = "1";
?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

<?php   $pay_id=$_GET['id'];?>


	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6"><a href="bulk_payment.php" style="font-size: 2px">
            <img src="gas.jpg" width="250" alt=""><BR>

	  <h5>Thimal Enterprises (Pvt.) Ltd <br>
	 33B/1 Katuwawala, boralasgamuwa <br>
	 011-2 509 801
<br>
		  <b>Pay id.<?php echo $pay_id; ?> </b><br>
	<br>
		  Date:<?php date_default_timezone_set("Asia/Colombo");
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>
			</h5></a>

        </div>
        <!-- /.col -->





          <small class="pull-right">
         <h4>
		  <?php



			   $invo=$_GET['id'];
				 $result = $db->prepare("SELECT * FROM payment  WHERE transaction_id='$pay_id'   ");
		 	  				$result->bindParam(':userid', $a);
		 	                  $result->execute();
		 	                  for($i=0; $row = $result->fetch(); $i++){

				echo "<b>Type: </b>".$row['type'];
					echo "<br>";
					echo "<b>Amount: </b>".$row['amount'];
					echo "<br>";
					echo "<b>CHQ No: </b>".$row['chq_no'];
					echo "<br>";
					echo "<b>Bank: </b>".$row['bank'];
					echo "<br>";
					echo "<b>CHQ Date: </b>".$row['chq_date'];
					echo "<br>_________________________";



				}


		  ?>
		</h4></small>
        <!-- /.col -->
		</div>

<div class="box-body">
	<table  class="table table-bordered table-striped">
		<thead>
		<tr>
<th>ID</th>
<th>Invoice no</th>
<th>Customer</th>
<th>Credit Amount (Rs.)</th>
<th>Pay Amount (Rs.)</th>

		</tr>
		</thead>
<tbody>

<?php $id=$_GET['id'];
$result = $db->prepare("SELECT * FROM credit_payment WHERE pay_id='$id' AND action='0' ");

$result->bindParam(':userid', $date);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){





echo '<tr class="record">';



 ?>


	 <td><?php echo $row['id'];   ?> </td>
<td><?php echo $row['sales_id'];   ?> </td>
<td><?php echo $row['cus'];   ?> </td>
<td>Rs.<?php echo $row['credit_amount'];   ?></td>
<td><?php echo $row['pay_amount'];   ?></td>

		</tr>


<?php }   ?>
</tbody>

	</table>


            </div><br><br><br><br>
	 <small class="pull-right"><img src="cloud.png" width="80" alt=""></small>

        </div>
	  __________________ <br> DEALER SIGNATURE
  </section>
</div>
</body>
</html>
