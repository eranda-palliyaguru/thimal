


<div style="width: 750px">


    <!-- Main content -->


      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product</h3>


        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="product_edit_save.php">

        <div class="box-body">



      <!-- /.box -->
<div class="form-group">

	<?php
	include('connect.php');
	$id=$_GET['id'];
	 $result = $db->prepare("SELECT * FROM products WHERE product_id='$id' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				$name=$row['gen_name'];
				$price=$row['price'];
        $price2=$row['price2'];
        $sell=$row['sell_price'];
				$o_price=$row['o_price'];
				}


	?>



	<div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                 <div class="input-group">
				   <div class="input-group-addon">
                    <b >Name</b>
                  </div>
                <input type="text" name="name" value="<?php echo $name ?>" class="form-control pull-right" required >
					 <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control pull-right" required >
                  </div>
                  </div>
				</div>

			  <div class="col-md-6">
              <div class="form-group">

                 <div class="input-group">
				   <div class="input-group-addon">
                    <b >Dealer Price</b>
                  </div>
                <input type="text" name="price" value="<?php echo $price ?>" class="form-control pull-right" required >

                  </div>
                  </div>
				</div>

        <div class="col-md-6">
              <div class="form-group">

                 <div class="input-group">
				   <div class="input-group-addon">
                    <b >Dealer Price (Kaluthara)</b>
                  </div>
                <input type="text" name="price2" value="<?php echo $price2 ?>" class="form-control pull-right" required >

                  </div>
                  </div>
				</div>


        <div class="col-md-6">
              <div class="form-group">

                 <div class="input-group">
           <div class="input-group-addon">
                    <b> Sell Price</b>
                  </div>
                <input type="text" name="sell" value="<?php echo $sell ?>" class="form-control pull-right" required >

                  </div>
                  </div>
        </div>


			  <div class="col-md-6">
			  <div class="form-group">

				  <div class="input-group">
				   <div class="input-group-addon">
                    <b >Cost Price</b>
                  </div>
                <input type="text" name="o_price" value="<?php echo $o_price ?>" class="form-control pull-right" >
                  </div>
                  </div></div>
              </div>
              </div>






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
