
<div style="width: 500px">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Special Price</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_special_price.php">
		
			
	
			
        <div class="box-body">
          <div class="row">
            
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			  
			    <div class="col-md-12">
             
                <label>Customer</label>
                <select class="form-control select2" name="cus" style="width: 350px;" autofocus >
                <option></option>  
                  
				  <?php include("connect.php");
                $result = $db->prepare("SELECT * FROM customer ORDER by customer_id ASC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_id']."_".$row['customer_name']; ?>    </option>
	<?php
				}
			?>
                </select>
				
              </div>

               
                <div class="col-md-6">
              <div class="form-group">
                <label>Product</label>
                <select class="form-control select2" name="pro_id" style="width: 100%;" autofocus >
                  
         <option value="1" >12.5Kg </option>   
		<option value="3" >37.5Kg </option>
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
				</div>
				 
			
	<div class="col-md-6">
              <div class="form-group">
                <label>Price</label>
                <input type="text" value='' id="datepicker" name="price" class="form-control pull-right" >
				</div>
              </div>
			  
			  
        
		
        </div>
      </div>
	  
	
				
        
		
        
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              

			  
			  
			  
			  <input class="btn btn-info" type="submit" value="Add" >
			  
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
   
