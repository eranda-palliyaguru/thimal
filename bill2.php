<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
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

<?php
if (!isset($_GET['id'])) {
	$inv=$_GET['invo'];
	$result = $db->prepare("SELECT * FROM sales WHERE   transaction_id='$inv'");
  $result->bindParam(':userid', $date);
 				 $result->execute();
 				 for($i=0; $row = $result->fetch(); $i++){
 					$invo=$row['invoice_number'];
 					$date=$row['date'];
 				 }
}else {

 $invo=$_GET['id'];
 $result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
 $result->bindParam(':userid', $date);
				 $result->execute();
				 for($i=0; $row = $result->fetch(); $i++){
					$date=$row['date'];
					$inv=$row['transaction_id'];
				 }


			 } ?>


	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6"><a href="sales2.php" style="font-size: 2px">
            <img src="gas.jpg" width="250" alt=""><BR>

	  <h5>Thimal Enterprises (Pvt.) Ltd <br>
	 33B/1 Katuwawala, Boralasgamuwa <br>
	 011-2 509 801<br>
		  <b>Invoice no.<?php echo $inv; ?> </b><br>
	<br>
		  Date:<?php date_default_timezone_set("Asia/Colombo");
    echo $date; echo "  Time-";  echo date("h:ia")  ?>
			</h5></a>

        </div>
        <!-- /.col -->




        <div class="col-xs-6">
          <small class="pull-right">
        </div> <h5>
		  <?php

				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				echo "<b>Customer: </b>".$row['name'].".....";
					echo "<br>";
					echo "<b>Customer id: </b>".$row['customer_id'];
					echo "<br>";
					echo "<b>loading id: </b>".$row['loading_id'];
					echo "<br>";


				}


		  ?>
			</h5></small>
        <!-- /.col -->
		  <div class="col-xs-4">
          <h3>Final Bill
		  <?php

					$tot_amount=0;		  ?>
			  </h3>
      </div></div>

<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>#</th>
				<th>Name</th>
               <th>Qty</th>
               <th>Price </th>
               <th>Amount </th>
                </tr>
                </thead>
                <tbody>
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");

					$tot_amount=0;
					$num=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$num+=1;
			?>
                <tr>
					<td><?php echo $num;?></td>
                  <td><?php echo $row['name'];?></td>
				  <td><?php echo $row['qty'];?></td>
                  <td>Rs.<?php echo $row['price'];?></td>
				  <td>Rs.<?php echo $row['amount'];?></td>
					<?php $tot_amount+= $row['amount'];?>
                  <?php } ?>
                 </tr>
					<tr>
					<td></td><td></td><td></td><td>Total: </td>


						<td>Rs.<?php echo $tot_amount;?></td>
					</tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
	<?php
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];
					$balance=$row1['balance'];
				}
			?>
	<div class="col-xs-8">

          <div class="table-responsive">
            <table class="table">
				<tr>
				<th>Type</th>
        <th>CHQ No.</th>
        <th>Bank</th>
				<th>Amount</th>
				<th>CHQ Date</th>
				<th>Date</th>
        </tr>

<?php
				$result1 = $db->prepare("SELECT * FROM payment WHERE invoice_no='$invo' and action > '0'  ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$credit_pay_id=$row1['credit_pay_id'];
				$transaction_id=$row1['transaction_id'];
			?>

		          	<tr>
				        <th><?php echo $row1['type']; ?></th>
                <th><?php echo $row1['chq_no']; ?></th>
                <th><?php echo $row1['bank']; ?></th>
				        <th>Rs.<?php echo $row1['amount']; ?></th>
								<th><?php echo $row1['chq_date']; ?></th>
			       	  <th><?php echo $row1['date']; ?></th>

                </tr>
			 <?php

			 $result2 = $db->prepare("SELECT * FROM credit_payment WHERE tr_id='$transaction_id' AND action='0'  ");
			 $result2->bindParam(':userid', $date);
			 $result2->execute();
			 for($i=0; $row2 = $result2->fetch(); $i++){
			 $sales_id=$row2['pay_id'];


			 $result = $db->prepare("SELECT * FROM payment WHERE transaction_id='$sales_id'  ");
			 $result->bindParam(':userid', $date);
							 $result->execute();
							 for($i=0; $row = $result->fetch(); $i++){
								  ?>
									<tr>
										<th><?php echo $row['type']; ?></th>
										<th><?php echo $row['chq_no']; ?></th>
										<th><?php echo $row['bank']; ?></th>
										<th>Rs.<?php echo $row['amount']; ?></th>

										<th><?php echo $row['chq_date']; ?></th>
										<th><?php echo $row['date']; ?></th>
							      </tr>
<?php } } } ?>

            </table>
          </div>
        </div>

            </div><br><br><br><br>
	 <small class="pull-right"><img src="cloud.png" width="80" alt=""></small>

        </div>
	  __________________ <br> DEALER SIGNATURE
  </section>
</div>
</body>
</html>
