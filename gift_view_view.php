

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"> GIFT VOUCHER</h3>

          
        <!-- /.box-header -->
		<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Voucher no.</th>
                  <th>NIC no.</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Contract</th>
				  <th>Product</th>
                  <th>Issued Date</th>
				  <th>Comment</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   include("connect.php");
   $result = $db->prepare("SELECT * FROM gift_voucher   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){	
			?>
                <tr  >
                  <td><?php echo $row['customer_name'];?></td>
                  <td><?php echo $row['voucher_no'];?></td>
                  <td><?php echo $row['nic_no'];?></td>
                  <td><?php echo $row['location'];?></td>
                  <td><?php echo $row['date'];?></td>
				  <td><?php echo $row['contract_no'];?></td>
				  <td><?php echo $row['product'];?></td>
				  <td><?php echo $row['issued_date'];?></td>
				  <td><?php echo $row['comment'];?></td>  
				 </tr  > 
				<?php }?>
				  
				  </tbody>
                <tfoot>
 
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          <!-- /.box -->

       
          
        

    
   
