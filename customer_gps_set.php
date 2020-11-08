<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GPS</title>
</head>

	
<?php 
session_start();
include("connect.php");
date_default_timezone_set("Asia/Colombo");


	$id=$_SESSION['SESS_MEMBER_ID'];
	
$l=$_POST['l'];
$q1=$_POST['q'];

$split = explode(".", $l);
            $y= $split[0];
			$m= $split[1];
	
	$co = substr($m,0,2) ;
	$l=$y.".".$co;
	
	
	$split = explode(".", $q1);
            $y1= $split[0];
			$m1= $split[1];
	
	$co1 = substr($m1,0,4) ;
	$q1=$y1.".".$co1;
			
	
	
echo "<br>L= ".$l."<br>.Q= ".$q1;
	
$c="2";
	
$sql = "INSERT INTO lorry_gps (l,q,user_id) VALUES (:a,:b,:c)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$l,':b'=>$q1,':c'=>$c));

	
$sql = "UPDATE user 
        SET l=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($l,$id));
	
	
$sql = "UPDATE user 
        SET q=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($q1,$id));
	

	
	?>	
<form action="customer_gps.php" method="post">
	
	<select class="form-control select2" name="cus" style="width:123px; padding:4px;" >
                    <?php
                $result = $db->prepare("SELECT * FROM customer WHERE  l=''  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name']; ?>    </option>
	<?php
				}
			?>
                   
                  </select>
	
	<input type="text" name="l" value="<?php echo $l; ?>" >
	<input type="text" name="q" value="<?php echo $q1; ?>" >
	
	<input class="btn btn-info" type="submit" value="Next" >
	</form>
	
<body>
</body>
</html>