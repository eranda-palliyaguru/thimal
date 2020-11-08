<?php
include("connect.php");

//get the q parameter from URL
$q=$_REQUEST["q"];
//find out which feed was selected
if($q=="Cash"){
?>
	 
                  <select class="form-control select3" name="source" style="width: 100%;" autofocus >
                  
                  
				  <?php
                $result = $db->prepare("SELECT * FROM loading WHERE bank_action='0' and action='unload'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
<option value="<?php echo $row['transaction_id'];?>"><?php echo $row['lorry_no']."__".$row['date']."__Rs.".$row['cash_total']; ?>    </option>
	<?php
				}
			?>
                </select>
	<?php }else{ ?>			  
     <select class="form-control select2" name="type" style="width: 100%;" autofocus tabindex="1" disabled >
                  
                </select>
		          <input type="hidden" value="" name="source">          
<?php
				}
			?>
