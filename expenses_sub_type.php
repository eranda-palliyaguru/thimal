












      <!-- SELECT2 EXAMPLE -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">New SUB Type</h3>


        <!-- /.box-header -->
		<div class="form-group">

		<form method="post" action="expenses_sub_type_save.php">

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>SUB Name</label>
                <input type="text" value=''  name="name" class="form-control pull-right" >
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>



           <div class="col-md-6">
             <div class="form-group">
               <label>Type</label>
               <select class="form-control select2" name="type" style="width: 100%;" onchange="showRSS(this.value)" autofocus tabindex="2" >
                 <option value="">.</option>

         <?php
 include("connect.php");
               $result = $db->prepare("SELECT * FROM expenses_types ");
   $result->bindParam(':userid', $ttr);
   $result->execute();
   for($i=0; $row = $result->fetch(); $i++){
   ?>
   <option value="<?php echo $row['sn'];?>"><?php echo $row['type_name']; ?> </option>
   <?php
       }
     ?>
               </select>

       </div>
             </div>





        </div>
      </div>












      <!-- /.box -->
<div class="form-group">





			  <input class="btn btn-danger" type="submit" value="Add" >

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
