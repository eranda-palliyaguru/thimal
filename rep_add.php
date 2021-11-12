





	



    
    

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">New Employee</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="rep_save.php">
		
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text"  name="rep_name" class="form-control pull-right" >
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			  
			  

               
                <div class="col-md-6">
              <div class="form-group">
                <label>Content no</label>
                <input type="text" value='' id="datepicker" name="content" class="form-control pull-right" >
                  
                  </div>
				</div>
				 
				
        
		
        </div>
      </div>
	
<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>User Name</label>
                <input type="text"  name="user" class="form-control pull-right" >
				</div>
              </div>

			  
			  

               
                <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control pull-right" >
                  
                  </div>
				</div>
				 
				
        
		
        </div>
      </div>
	  
	  
	   <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Type</label>
                <select name="content" class="form-control pull-right" >
			<option value="1">Driver</option>
			<option value="2">Helper</option>
			</select>
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
			  
			  

               
               
				
        
		
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

    
   
