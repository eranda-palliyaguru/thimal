





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">New Sales</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="get" action="unloding_stock.php">
		
        <div class="box-body">
          
	  
	  
	  <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Lorry</label>
                  <select class="form-control select2" name="id" style="width:100%;" autofocus >
                    <?php
					include("connect.php");
                $result = $db->prepare("SELECT * FROM loading WHERE  action='load'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['transaction_id'];?>"><?php echo $row['lorry_no']; ?>    </option>
	<?php
				}
			?>
                    
                  </select>
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
		
		
		
				  
				  
	
		
		
		
		
		<br>
		
		
		
	
			  
			  
			  
			  
			  <input class="btn btn-info" type="submit" value="unload" >
			  
			  </form>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
       

        
            <!-- /.box-body -->
            
            </div>
          </div>
