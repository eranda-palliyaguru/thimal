


<div style="width: 750px">


    <!-- Main content -->


      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Payment</h3>


        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="credit_collection_edit_save.php">

        <div class="box-body">



      <!-- /.box -->
<div class="form-group">

	<?php
	include('connect.php');
	$id=$_GET['id'];
	 $result = $db->prepare("SELECT * FROM collection WHERE id='$id' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				$type=$row['pay_type'];
				$amount=$row['amount'];
				$chq_no=$row['chq_no'];
				$bank=$row['bank'];
				$chq_date=$row['chq_date'];
        $sales_id=$row['invoice_no'];
        $pay_credit=$row['type'];
				}
$f="disabled";
if ($sales_id>0) { $f=""; }
if ($pay_credit=="1") { $f="disabled"; }

	?>



	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
  <label>Type</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <b ><?php echo $type ?></b>
                  </div>
                <input type="text" name="type"  class="form-control pull-right" autocomplete="off" disabled>

                  </div>
                  </div>
				</div>

			  <div class="col-md-6">
              <div class="form-group">
  <label>Amount</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <b >Rs.<?php echo $amount ?></b>
                  </div>
                <input type="text" name="amount" class="form-control pull-right" autocomplete="off" <?php echo $f; ?>>
                  </div>
                  </div>
				</div>
              </div>



              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
          <label>Bank</label>
                     <div class="input-group">
               <div class="input-group-addon">
                        <b ><?php echo $bank ?></b>
                      </div>
                    <input type="text" name="bank"  class="form-control pull-right" autocomplete="off" >

                      </div>
                      </div>
            </div>

            <div class="col-md-6">
                  <div class="form-group">
          <label>CHQ No.</label>
                     <div class="input-group">
               <div class="input-group-addon">
                        <b ><?php echo $chq_no ?></b>
                      </div>
                    <input type="text" name="chq_no" class="form-control pull-right" autocomplete="off" >
                      </div>
                      </div>
            </div>
                  </div>



                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
              <label>CHQ Date</label>
                         <div class="input-group">
                   <div class="input-group-addon">
                            <b ><?php echo $chq_date ?></b>
                          </div>
                        <input type="text" name="chq_date"  class="form-control pull-right" autocomplete="off" >

                          </div>
                          </div>
                </div>

                <div class="col-md-6">
                                 <div class="alert alert-danger alert-dismissible">
                                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                               <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                               Fill in only the blanks that need to be changed
                                             </div> </div>
                      </div>



              </div>


<input type="hidden" name="id" value="<?php echo $id; ?>">
			  <input class="btn btn-info" type="submit" value="Submit" >

			  </form>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->



            <!-- /.box-body -->

            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
     </div>
