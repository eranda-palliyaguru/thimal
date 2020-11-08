





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">New Load</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="get" action="emty_loading2.php">
		
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Yard</label>
                <select class="form-control select2" name="yard" style="width:100%;" autofocus >
                  
                  
				  <option value="1">Kaluthara Yard </option>
		<option value="2">Payagala Yard </option>
		<option value="3">Other Yard </option>
                </select>
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			  
			  
      </div>
	  
	  
	  <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Lorry</label>
                  <select class="form-control select2" name="lorry" style="width:100%;" autofocus >
                    <?php
					include("connect.php");
                $result = $db->prepare("SELECT * FROM lorry WHERE  action='unload'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['lorry_no'];?>"><?php echo $row['lorry_no']; ?>    </option>
	<?php
				}
			?>
                    
                  </select>
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
		
		
		
				  
				  
	
		
		
		
		
		<br>
		
		
		
	
			  
			  
			  
			  
			  <input class="btn btn-info" type="submit" value="Load" >
			  
			  </form>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
       

        
            <!-- /.box-body -->
            
            </div>
          </div>
