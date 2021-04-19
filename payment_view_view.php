<h2>
<?php
include("connect.php");
 $invo1=$_REQUEST['id'];
 $pay_amount=$_REQUEST['pay_amount'];
$pay_id=$_REQUEST['pay_id'];
   $result = $db->prepare("SELECT * FROM sales WHERE transaction_id='$invo1'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
 echo $row['name'];
					$invo=$row['invoice_number'];
					//$balance= $row['pay_amount'];
					$cus_id= $row['customer_id'];

					$lorry= $row['lorry_no'];
				}

        $result = $db->prepare("SELECT * FROM payment WHERE transaction_id='$pay_id'   ");
     				$result->bindParam(':userid', $date);
                     $result->execute();
                     for($i=0; $row = $result->fetch(); $i++){
     				$pay_amount=$row['pay_amount'];
              	$amount= $row['amount'];
     				}

?></h2>
        <!-- /.box-header -->
<a class="label pull-left bg-orange" style="font-size: 100%" >Invoice- <?php echo $invo1 ?></a>

              <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr>
                  <th>Product_code</th>
                  <th>Product_name</th>
                  <th>Price</th>
                  <th>QTY</th>
                </tr>
                </thead>
                <tbody>
				<?php

   $result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no='$invo'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$total= $row['sum(price)'];
				}




   $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$invo'   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
			?>
                <tr  >
                  <td><?php echo $row['code'];?></td>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['price'];?></td>
                  <td><?php echo $row['qty'];?></td>
					</tr  >

				<?php }?>

				  </tbody>
                <tfoot>

                </tfoot>
              </table>
<small class="label pull-right bg-green"><h2>Total Rs.<?php echo $amount;?></h2></small>

     <small class="label pull-left bg-red"><h2>Balance Rs.<?php echo $balance=$amount-$pay_amount;?></h2></small>
		<br><br><br>
<form method="post" action="save_payment.php">
	<input type="hidden" name="invoice_id" value="<?php echo $pay_id; ?>" >
			 <input type="hidden" name="order_id" value="<?php echo $invo1; ?>"  >
			 <input type="hidden" name="from" value="payment"  >
			 <input type="hidden" name="bill_total" value="<?php echo $total;?>"  >
			 <input type="hidden" name="balance" value="<?php echo $balance;?>"  >
             <input type="hidden" name="cus_id" value="<?php echo $cus_id;?>"  >
	        <input type="hidden" name="r" value="<?php // echo $_GET['r'];?>"  >
	        <input type="hidden" name="cus" value="<?php echo $_GET['cus'];?>"  >
	<div class="col-md-10">
		<select name="p_type" class="form-control" id="p_type" onchange="view_payment_date(this.value);">
            <option value="0" style="color: red" >Payment Method</option>
			<option value="cash">Cash</option>
            <option value="chq">Cheque</option>
			<option value="coupon">Coupon</option>
			<option value="bank">Bank Transfer</option>
                      </select>

 	<div class="form-group" id='coupon' style="display:none;">
         <label for="exampleInputPassword1">Amount</label>
         <div class="input-group">
       <input type="text" name="cup_amount" class="form-control pull-right" autocomplete="off" >
       </div>
	   <label for="exampleInputPassword1">Coupon NO.</label>
         <div class="input-group">
           <input type="text" name="cup_no" class="form-control pull-right">
       </div>


      <br>
	<input class="btn btn-info" type="submit" value="Pay" >

		</div>


		<div class="form-group" id='bank' style="display:none;">
         <label for="exampleInputPassword1">Amount</label>
         <div class="input-group">
       <input type="text" name="tr_amount" class="form-control pull-right" autocomplete="off" >
       </div>
		<label for="exampleInputPassword1">Bank.</label>
         <div class="input-group">
           <input type="text" name="tr_bank" class="form-control pull-right">
       </div>

	   <label for="exampleInputPassword1">Date of Transfer.</label>
         <div class="input-group">
           <input type="text" name="tr_date" class="form-control pull-right" id="bank_tr"autocomplete="off">
       </div>


      <br>
	<input class="btn btn-info" type="submit" value="Pay" >

		</div>


		 <div class="form-group" id='cash_pay' style="display:none;">
         <label for="exampleInputPassword1">Cash Amount</label>
         <div class="input-group">
           <input type="text" name="cash_amount" class="form-control pull-right" autocomplete="off" >
       </div>
     <br>
	<input class="btn btn-info" type="submit" value="Pay" >

		</div>


		 <div class="form-group" id='chq_pay' style="display:none;">
         <label for="exampleInputPassword1">Cheque No</label>
         <div class="input-group">
           <input type="text" name="chq_no" class="form-control pull-right" autocomplete="off" >
       </div>
		<label for="exampleInputPassword1">Bank</label>
         <div class="input-group">
           <input type="text" name="bank" class="form-control pull-right">
       </div>
			 <label for="exampleInputPassword1">Amount</label>
         <div class="input-group">
           <input type="text" name="chq_amount" class="form-control pull-right" autocomplete="off" >
       </div>
			  <label for="exampleInputPassword1">Date</label>
         <div class="input-group">
           <input type="text" name="chq_date" class="form-control pull-right" id="chq"autocomplete="off">
       </div>
      <br>
	<input class="btn btn-info" type="submit" value="Pay" >

		</div>

		<div id="form_continue"></div>
	            <!-- /btn-group -->



		</div>

			</form>

 <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


    //Date picker
   $('#chq').datepicker({
      autoclose: true, format: 'yyyy-mm-dd'
    });

	$('#bank_tr').datepicker({
      autoclose: true, format: 'yyyy-mm-dd'
    });




  });


 function view_payment_date(type){
	if(type=='coupon'){
	document.getElementById('coupon').style.display='block';
	document.getElementById('cash_pay').style.display='none';
	document.getElementById('chq_pay').style.display='none';
	document.getElementById('bank').style.display='none';
		} else if(type=='chq'){
		document.getElementById('chq_pay').style.display='block';
		document.getElementById('coupon').style.display='none';
		document.getElementById('cash_pay').style.display='none';
		document.getElementById('bank').style.display='none';
			}else if(type=='cash'){
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('coupon').style.display='none';
		document.getElementById('cash_pay').style.display='block';
		document.getElementById('bank').style.display='none';
			}else if(type=='bank'){
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('coupon').style.display='none';
		document.getElementById('cash_pay').style.display='none';
		document.getElementById('bank').style.display='block';
			}else {
		document.getElementById('chq_pay').style.display='none';
		document.getElementById('coupon').style.display='none';
		document.getElementById('cash_pay').style.display='none';
		document.getElementById('bank').style.display='none';
			}
	 }
  </script>
