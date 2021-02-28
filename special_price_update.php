
<div style="width: 500px">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Special Price Update</h3>


        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="save_special_price_update.php">




        <div class="box-body">
          <div class="row">

			   <?php date_default_timezone_set("Asia/Colombo"); ?>

			    <div class="col-md-12">

                <label>product</label>
                <select class="form-control select2" name="product" style="width: 350px;" autofocus >
                  <?php include("connect.php");
                          $result = $db->prepare("SELECT * FROM products ORDER by product_id ASC ");
          		$result->bindParam(':userid', $res);
          		$result->execute();
          		for($i=0; $row = $result->fetch(); $i++){
          	?>
          		<option value="<?php echo $row['product_id'];?>"><?php echo $row['gen_name']; ?>    </option>
          	<?php
          				}
          			?>
                </select>
              </div>


                <div class="col-md-6">
              <div class="form-group">
                <label>price</label>
                <select class="form-control select2" name="price" style="width: 100%;" autofocus >
			  <?php include("connect.php");
                $result = $db->prepare("SELECT DISTINCT price FROM special_price ORDER by id ASC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['price'];?>"><?php echo $row['price']; ?>    </option>
	<?php
				}
			?>
                </select>

                  </div>
				</div>


	<div class="col-md-6">
              <div class="form-group">
                <label>Update Price</label>
                <input type="text" value='' id="datepicker" name="up_price" class="form-control pull-right" >
				</div>
              </div>




        </div>
      </div>








      <!-- /.box -->
<div class="form-group">





			  <input class="btn btn-danger" type="submit" value="UPDATE" >

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
      <!-- /.row -->
</div>


<script src="../../plugins/select2/select2.full.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

   $(".select2").select2();

  });

</script>
