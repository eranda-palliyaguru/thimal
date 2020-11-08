

    <!-- Main content -->
   

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">New Loading</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form  rel="facebox" method="get" action="unload_loading2.php">
		
        <div class="box-body">
         
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
		
		
		<input name="lorry" type="hidden" value="<?php echo $_GET['lorry'];?>">
		
		
			

<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Rep</label>
                <select class="form-control select2" name="rep" style="width:100%;" autofocus >
                  
                  
				  <?php
				  include("connect.php");
                $result = $db->prepare("SELECT * FROM rep  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['rep_name'];?>"><?php echo $row['rep_name']; ?>    </option>
	<?php
				}
			?>
                </select>
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			  
			  <div class="form-group">
               <label>Root</label>

                <div class="input-group date">
                  <select class="form-control select2" name="root" style="width:123px; padding:4px;" autofocus >
                  
                  
				  <?php
                $result = $db->prepare("SELECT * FROM root  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['root_name'];?>"><?php echo $row['root_name']; ?>    </option>
	<?php
				}
			?>
                </select>
                </div>
				
        
		
        </div>
      </div>
	  </div>
			
				  
				  <label>Yard</label>
                  <select class="form-control" name="yard" style="width:123px; padding:4px;" >
                    
		<option value="1" >Kaluthara Yard</option>
		<option value="2" >Payagala Yard</option>
	    <option value="3" >Other Yard</option>
                  </select>
		
		
		
		
		<br>
		
		
		
	
			  
			  
			  
			  
			  <input class="btn btn-info" type="submit" value="Next" >
			  
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
