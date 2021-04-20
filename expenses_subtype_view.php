<?php include("connect.php");
//get the q parameter from URL
$q=$_REQUEST["q"];
//find out which feed was selected

?>

                  <select class="form-control select2" name="sub_type" style="width: 100%;" autofocus >


				  <?php
                $result = $db->prepare("SELECT * FROM  expenses_sub_type WHERE type_id='$q' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>    </option>
	<?php
				}
			?>
      	<option value="1">Other</option>
                </select>
