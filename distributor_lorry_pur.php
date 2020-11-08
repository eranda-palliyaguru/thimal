





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">New Load</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_dis_purchase.php">
		
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>rep</label>
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
			  
			  
			  
			  
			  <div class="col-md-6">
              <div class="form-group">
                <label>Invoice no</label>
                <input type="text" name="invoice" class="form-control pull-right"  >
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
                $result = $db->prepare("SELECT * FROM lorry WHERE  action='Purchases'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['lorry_no'];?>"><?php echo $row['lorry_no']; ?>    </option>
	<?php
				}
			?>
                    
                  </select>
	   				  
					 </div>
          </div>	
		  
		  
		  
		  
		   <div class="col-md-6">
              <div class="form-group">
                <label>root</label>
                  <select class="form-control select2" name="root" style="width:100%;" autofocus >
                    <?php
					include("connect.php");
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
          
      <!-- /.box -->
<div class="form-group">
              
		
		
		
				  
				  
	
		
		
		
		
		<br>
		
		
		
	
			  
			  
			  
			  
			  <input class="btn btn-info" type="submit" value="Submit" >
			  
			  </form>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
       

        
            <!-- /.box-body -->
            
            </div>
          </div>
