
 
 <input type="hidden" name="item2"  value="0" >
  <input type="hidden" name="qty2"  value="0"  >
  
  <input type="hidden" name="item3"  value="0" >
  <input type="hidden" name="qty3"  value="0"  >
  
  <input type="hidden" name="item4"  value="0" >
  <input type="hidden" name="qty4"  value="0"  >
  
  <input type="hidden" name="item5"  value="0" >
  <input type="hidden" name="qty5"  value="0"  >
  
  <input type="hidden" name="item6"  value="0" >
  <input type="hidden" name="qty6"  value="0"  >
  
  <input type="hidden" name="item7"  value="0" >
  <input type="hidden" name="qty7"  value="0"  >
  
  <input type="hidden" name="item8"  value="0" >
  <input type="hidden" name="qty8"  value="0"  >
  
  <input type="hidden" name="item9"  value="0" >
  <input type="hidden" name="qty9"  value="0"  >
  
  
 
 
 
 
 
 <!--------------------------------- */ colom 1 --------------------------------------------------------->
 
 <tr >
                  <td><select class="form-control select2" name="item1" multiple="1" data-placeholder="Select a State" value='' style="width: 80%;" >
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty1" class="form-control pull-right"   ></td>                  
                </tr>
				
				
				
				
	<!--------------------------------- */ colom 2 --------------------------------------------------------->			
				
				
				
				
				
				
				<tr >
                  <td><select class="form-control select2" name="item2" multiple="1" data-placeholder="Select a State" style="width: 80%;" value='' >
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty2" class="form-control pull-right"   ></td>                  
                </tr>
				
				
	<!--------------------------------- */ colom 3 --------------------------------------------------------->			
				
				<tr >
                  <td><select class="form-control select2" name="item3" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty3" class="form-control pull-right"   ></td>                  
                </tr>
				
				
				
				
					<!--------------------------------- */ colom 4 --------------------------------------------------------->			
				
				<tr >
                  <td><select class="form-control select2" name="item4" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty4" class="form-control pull-right"   ></td>                  
                </tr>
      
	  <!--------------------------------- */ colom 5 --------------------------------------------------------->
	  
	  
	  <tr >
                  <td><select class="form-control select2" name="item5" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty5" class="form-control pull-right"   ></td>                  
                </tr>
				
				
		<!--------------------------------- */ colom 6 --------------------------------------------------------->		
				
				
				
				<tr >
                  <td><select class="form-control select2" name="item6" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty6" class="form-control pull-right"   ></td>                  
                </tr>
				
				
	<!--------------------------------- */ colom 7 --------------------------------------------------------->			
				
				
				<tr >
                  <td><select class="form-control select2" name="item7" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty7" class="form-control pull-right"   ></td>                  
                </tr>
				
	<!--------------------------------- */ colom 8 --------------------------------------------------------->			
				
				
				
				<tr >
                  <td><select class="form-control select2" name="item8" multiple="1" data-placeholder="Select a State" style="width: 80%;" value=''>
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty8" class="form-control pull-right"   ></td>                  
                </tr>
				
				
	<!--------------------------------- */ colom 9 --------------------------------------------------------->			
				
				
				<tr >
                  <td><select class="form-control select2" name="item9" multiple="1" data-placeholder="Select a State" style="width: 80%;"value='' >
				   <option></option>
                    <?php
                $result = $db->prepare("SELECT * FROM products  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gen_name'];?>"><?php echo $row['gen_name']; ?>    </option>
	<?php
				}
			?>
                    
                  </select> </td>
                  <td><input type="text" name="qty9" class="form-control pull-right"   ></td>                  
                </tr>