





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"> Damage Receive</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="damage_receive_save.php">
		
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Complain No</label>
                <select class="form-control select2" name="complain_no" style="width: 100%;" autofocus >
                  
                  
				  <?php
				  include("connect.php");
                $result = $db->prepare("SELECT * FROM damage WHERE  action='Sent Company'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['complain_no'];?>"><?php echo $row['complain_no']; ?>    </option>
	<?php
				}
			?>
                </select>
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			   
			   <div class="col-md-6">
              <div class="form-group">
                <label>	Driver</label>
                <select class="form-control select2" name="yard" style="width: 100%;" autofocus >
                 <option >Kaluthara Yard</option>
				 <option >Payagala Yard</option>
                  
                  </div>
				</div>
			   
			   
        </div>
      </div>
	  
	  
	  
	  
				
        
		
        
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              

			  
			  
			  
			  <input class="btn btn-info" type="submit" value="Receive" >
			  
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

    
   
