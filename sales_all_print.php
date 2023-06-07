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
?><meta http-equiv="refresh" content="<?php echo $sec;$d1=$_GET['d1'];?>;URL='sales_all_rp.php?d1=<?php echo $d1;?>'">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i><?php $result = $db->prepare("SELECT * FROM info");
           $result->bindParam(':userid', $date);
          				 $result->execute();
          				 for($i=0; $row = $result->fetch(); $i++){
          					 echo $row['name'];
          					} ?>

          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo");
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
		<h4>
		<?php echo "FROM- ".$_GET['d1']." TO- ".$_GET['d2']; ?>
        <img class="pull-right" style="width:90px" src="cloud.png" alt="">
		<h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <!-- /.row -->
<div class="box-body">
  <table id="example2" class="table table-bordered table-hover">
      <tr >
        <th style="background-color:#aba272"></th>
        <th colspan="3" style="background-color:#aba272"><center>Dealer Kaluthara</center></th>
        <th colspan="3"style="background-color:#aba272" ><center>Dealer Colombo</center></th>
        <th colspan="3"style="background-color:#aba272"><center>Selling</center></th>
        <th colspan="3"style="background-color:#aba272"><center>Discount</center></th>
        <th colspan="3"style="background-color:#aba272"><center>Total</center> </th>
             </tr>

              <tr>
                <th style="background-color:#aba272">Product Name</th>
                <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
                <th style="background-color:rgba(191,161,6,0.73)">Value</th>
                <th style="background-color:#bfa106">Margin</th>

                <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
                <th style="background-color:rgba(191,161,6,0.73)">Value</th>
                <th style="background-color:#bfa106">Margin</th>

                <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
                <th style="background-color:rgba(191,161,6,0.73)">Value</th>
                <th style="background-color:#bfa106">Margin</th>

                <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
                <th style="background-color:rgba(191,161,6,0.73)">Value</th>
                <th style="background-color:#bfa106">Margin</th>

                <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
                <th style="background-color:rgba(191,161,6,0.73)">Value</th>
                <th style="background-color:#bfa106">Margin</th>

                      </tr>
    <?php
    $d1=$_GET['d1'];
    $d2=$_GET['d2'];
    $total=0;
    //$invo=$_GET['id'];
$or_d1=$d1;
$margin_total=0;
    $result1 = $db->prepare("SELECT * FROM products  ORDER by product_id ASC");
    $result1->bindParam(':userid', $d2);
    $result1->execute();
    for($i=0; $row1 = $result1->fetch(); $i++){
    $tebal_id=$row1['product_id'];
    $price=$row1['price'];
    $price2=$row1['price2'];
    $price_o=$row1['o_price'];
  //  $area=$row1['area'];

$dealer=0;$dealer1=0; $dealer_qty=0;$dealer_qty1=0; $sell=0;$sell_val=0;  $dis=0;$dis_val=0; $sell_m=0;$dis_m=0;$dis_m1=0; $dealer_m=0;  $dealer_m1=0; $sell_v1=0;

    $result1122 = $db->prepare("SELECT * FROM price_update WHERE product_id='$tebal_id'  ORDER BY id ASC ");
    $result1122->bindParam(':userid', $invo);
    $result1122->execute();
    for($i=0; $row1122 = $result1122->fetch(); $i++){
//$dealer_v=0;$dealer1_v=0; $dealer_qty_v=0;$dealer_qty1_v=0; $sell_v=0;$sell_val_v=0;  $dis_v=0;$dis_val_v=0;

include("sales_all_rp_price_update.php");


        }

?>
<tr>
 <td style="background-color:#aba272"><?php echo $row1['gen_name']; ?></td>

 <td style="background-color:rgba(191,161,6,0.42)">
   <?php
   $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $dealer_qty_s=$row['sum(qty)'];}

      echo $dealer_qty+$dealer_qty_s;

 ?></td>
 <td style="background-color:rgba(191,161,6,0.73)">
   <?php 
   $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){  $dealer_s  = $row['sum(amount)'];  }
   echo number_format($dealer+$dealer_s,2);

     $dma=$dealer_s-($price_o*$dealer_qty_s);
 ?></td>

 <td style="background-color:#bfa106"> <?php     echo number_format($dealer_m=$dma+$dealer_m,2);   ?></td>


 <td style="background-color:rgba(191,161,6,0.42)">
   <?php
   $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $dealer_qty1_s=$row['sum(qty)'];}
  echo  $dealer_qty1+$dealer_qty1_s;



 ?></td>
 <td style="background-color:rgba(191,161,6,0.73)">
   <?php
   $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'   AND  price = '$price' AND price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){  $dealer1_s= $row['sum(amount)']; }
  echo $dealer1+$dealer1_s;


  $dma1=$dealer1_s-($price_o*$dealer_qty1_s);
 ?></td>

 <td style="background-color:#bfa106"> <?php  echo number_format($dealer_m1=$dma1+$dealer_m1,2);  ?></td>


<?php


?>

 <td style="background-color:rgba(191,161,6,0.42)">
   <?php
   $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $sell_s=$row['sum(qty)'];}
if ($sell+$sell_s > 0) {
  echo $sell+$sell_s;
}

 ?></td>
 <td style="background-color:rgba(191,161,6,0.73)">
   <?php
   $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $sell_val_s=$row['sum(amount)']; }
if ($sell_val+$sell_val_s > 0) {
    echo number_format($sell_val+$sell_val_s,2);
}


      $sell_ma=$sell_val_s-($price_o*$sell_s)
 ?></td>

 <td style="background-color:#bfa106"> <?php  echo number_format($sell_m=$sell_m+$sell_ma,2);   ?></td>




 <td style="background-color:rgba(191,161,6,0.42)">
   <?php
   $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $dis_s=$row['sum(qty)'];}
   if ($dis+$dis_s > 0) {
     echo $dis=$dis+$dis_s;
   }

 ?></td>
 <td style="background-color:rgba(191,161,6,0.73)">
   <?php
   $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $dis_val_s=$row['sum(amount)'];}
   if ($dis_val+$dis_val_s > 0) {
       echo number_format($dis_val+$dis_val_s,2);
   }


      $dis_ma=($price-$price_o)*$dis_s;
      $ma11=$dis_val_s-($price*$dis_s);
 ?></td>

 <td style="background-color:#bfa106"> <?php  if ($dis_ma+$dis_m1 > 0) {
   echo number_format($dis_ma=$dis_ma+$dis_m1,2); ?> (<?php echo $ma11+$dis_m.')';
 }  ?></td>



 <td style="background-color:rgba(191,161,6,0.42)">
   <?php 				$d1=$_GET['d1'];
          $d2=$_GET['d2'];
   $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND    action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $dis1=$row['sum(qty)'];
      echo $row['sum(qty)']; }
 ?></td>
 <td style="background-color:rgba(191,161,6,0.73)">
   <?php
   $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'  AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
   $result->bindParam(':userid', $invo);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){ $total+=$row['sum(amount)'];
     if ($row['sum(amount)'] > 0) {
    echo number_format($row['sum(amount)'],2);
     }
       }
 ?></td>

 <td style="background-color:#bfa106"> <?php $margin_total+=$dealer_m+$dealer_m1+$sell_m+$dis_ma;   echo number_format($dealer_m+$dealer_m1+$sell_m+$dis_ma,2); // Margin total  ?></td>



         </tr>

         <?php
       }?>
       <tr>

         <td colspan="14"style="background-color:#aba272"><center>Total</center> </td>
         <td style="background-color:#aba272"> Rs.<?php   echo number_format($total,2); // Margin total  ?></td>
         <td style="background-color:#aba272"> Rs.<?php   echo number_format($margin_total,2); // Margin total  ?></td>
       </tr>
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
