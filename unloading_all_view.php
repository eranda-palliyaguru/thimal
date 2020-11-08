





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Unloading</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="get" action="unloading_view2.php">
		 <?php date_default_timezone_set("Asia/Colombo");
$date=date("Y/m/d");
		 ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" name="d" value="<?php echo $date; ?>" >
				</div>
              </div>
			  
			  
			  
      </div>
	  
	  
	  <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Lorry</label>
                  <select class="form-control select2" name="lorry_no" style="width:100%;" autofocus >
                    <?php
					include("connect.php");
                $result = $db->prepare("SELECT * FROM lorry WHERE  action='load'  ");
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
		
		
		
	
			  
			  
			  
			  
			  <input class="btn btn-info" type="submit" value="view" >
			  
			  </form>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
       

        
            <!-- /.box-body -->
            
            </div>
          </div>
