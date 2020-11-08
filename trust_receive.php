





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"> Trust Receive</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="trust_receive_save.php">
		<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" class="form-control pull-right"  >
                
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                 <label>Location</label>
                  <select class="form-control pull-right" name="location"  >
                    
		<option >Waththala Yard</option>
		
	    
                  </select>
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			   <div class="col-md-6">
              <div class="form-group">
                
                  
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

    
   
