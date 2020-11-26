<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
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
$_SESSION['page']="END";
$admin=$_SESSION['SESS_LAST_NAME'];
if($admin=="admin"){
?>
<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales2.php?bill=1'">
<?php
}else{
?>	<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales_start.php'">
<br>
<?php } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">




	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6"><a href="sales2.php" style="font-size: 2px">
            <img src="gas.jpg" width="250" alt=""><BR>

	  <h5>NO.135, Negombo. <br>


		  <b>Invoice no.<?php echo $_GET['id']; ?> </b><br>
	<b>mm </b><br>
		  Date:<?php date_default_timezone_set("Asia/Colombo");
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>
			</h5></a>

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
				}
			?>
	<div class="col-xs-6">

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
				$result1 = $db->prepare("SELECT * FROM payment WHERE invoice_no='$invo' and type='chq' ");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];


			?>

			<tr>
				<th><?php echo $row1['type']; ?></th>
                <th><?php echo $row1['chq_no']; ?></th>
                <th><?php echo $row1['bank']; ?></th>
				<th>Rs.<?php echo $row1['amount']; ?></th>
				<th><?php echo $row1['date']; ?></th>
              </tr>
			 <?php } ?>
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
