<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
include("head.php");
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
session_start();
  $user_lewal=$_SESSION['USER_LEWAL'];
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
<div class="col-xs-6">
<?php   $invo=$_GET['id'];
 $result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
 $result->bindParam(':userid', $date);
				 $result->execute();
				 for($i=0; $row = $result->fetch(); $i++){
					$invo=$row['transaction_id'];
					$date=$row['date'];
				 } ?>


	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <img src="gas.jpg" width="250" alt=""><BR>

	  <h4>Thimal Enterprises (Pvt.) Ltd <br>
	 33B/1 Katuwawala, Boralasgamuwa <br>
	 011-2 509 801<br>
		  <b>Invoice no.<?php echo $invo; ?> </b><br>
	<br>
		  Date:<?php date_default_timezone_set("Asia/Colombo");
    echo $date; echo "  Time-";  echo date("h:ia")  ?>
  </h4>

        </div>
        <!-- /.col -->




        <div class="col-xs-6">
          <small class="pull-right">
        </div> <h5>
		  <?php



			   $invo=$_GET['id'];
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                  $loading_id=$row['loading_id'];
                  $lorry_no=$row['lorry_no'];
                  $date=$row['date'];
                  $rem=$row['remove_user'];
                    $reason=$row['reason'];
                      $sales_id=$row['transaction_id'];

				echo "<H3><b>Customer: </b>".$row['name']."</H3>";
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
			  $invo=$_GET['id'];
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
		$invo=$_GET['id'];
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
          $cashi=$row1['cashier'];
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
			       	  <th><?php echo $row1['date']; ?></th>
                </tr>
			 <?php

			 $result2 = $db->prepare("SELECT * FROM credit_payment WHERE tr_id='$transaction_id' AND action='0'  ");
			 $result2->bindParam(':userid', $date);
			 $result2->execute();
			 for($i=0; $row2 = $result2->fetch(); $i++){
			 $pay_id=$row2['pay_id'];


			 $result = $db->prepare("SELECT * FROM payment WHERE transaction_id='$pay_id'  ");
			 $result->bindParam(':userid', $date);
							 $result->execute();
							 for($i=0; $row = $result->fetch(); $i++){
								  ?>
									<tr>
										<th><?php echo $row['type']; ?></th>
										<th><?php echo $row['chq_no']; ?></th>
										<th><?php echo $row['bank']; ?></th>
										<th>Rs.<?php echo $row['amount']; ?></th>
										<th><?php echo $row['date']; ?></th>
							      </tr>
<?php } } }


 ?>

            </table>
          </div>
        </div>

            </div><br><br><br><br>
	 <small class="pull-right"><img src="cloud.png" width="80" alt=""></small>

        </div>

        <?php
        $result1 = $db->prepare("SELECT * FROM user WHERE id='$rem' ");
        $result1->bindParam(':userid', $res);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){
        $user=$row1['name'];
        $upic=$row1['upic'];
        }


        $result1 = $db->prepare("SELECT * FROM employee WHERE id='$cashi' ");
       $result1->bindParam(':userid', $res);
       $result1->execute();
       for($i=0; $row1 = $result1->fetch(); $i++){
       $cashi_pic=$row1['pic'];
       $cashi_name=$row1['name'];
       } ?>
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $cashi_name; ?></h3>
              <h5 class="widget-user-desc">Driver &amp; DSR</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo $cashi_pic; ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <span class="description-text">Loading ID</span>
                    <h5 class="description-header"><?php echo $loading_id; ?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <span class="description-text">Lorry no</span>
                    <h5 class="description-header"><?php echo $lorry_no; ?></h5>

                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <span class="description-text">Date</span>
                    <h5 class="description-header"><?php echo $date; ?></h5>

                  </div>
                  <!-- /.description-block -->
                </div>

        </div></div></div></div>
<div class="col-sm-4 border-right">
        <div class="box-footer box-comments">
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="<?php echo $upic; ?>" alt="User Image">

          <div class="comment-text">
                <span class="username">
                  <?php echo $user; ?>
                  <span class="text-muted pull-right">Reason</span>
                </span><!-- /.username -->
          <?php echo $reason; ?>
          </div>
          <!-- /.comment-text -->
        </div>  </div>  </div>

        <div class="col-sm-4 border-left"><?php if ($user_lewal == 1) {?>
          <form method="post" action="bill_remove_app_save.php">
<input type="hidden" name="id" value="<?php echo $sales_id; ?>">
 <input class="btn btn-success" type="submit" value="Approve" >
</form><?php } ?>
</div>
  </section>
</div>

</body>
</html>
