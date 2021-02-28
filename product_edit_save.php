<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include('connect.php');
$user_id=$_SESSION['SESS_MEMBER_ID'];

$id =$_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$price2 = $_POST['price2'];
$o_price = $_POST['o_price'];
$sell_price=$_POST['sell'];


$date=date('Y-m-d');
$time=date('H.i.s');

$result1 = $db->prepare("SELECT * FROM products WHERE product_id='$id' ");
		$result1->bindParam(':userid', $id);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$old_d=$row1['price'];
    $old_d2=$row1['price2'];
    $old_o=$row1['o_price'];
    $old_sell=$row1['sell_price'];
		}

$sql= "INSERT INTO price_update (name,product_id,old_d_price,old_d_price2,old_sell_price,old_o_price,d_price,d_price2,sell_price,o_price,date,time,user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$id,$old_d,$old_d2,$old_sell,$old_o,$price,$price2,$sell_price,$o_price,$date,$time,$user_id));

$result1 = $db->prepare("SELECT id FROM price_update WHERE product_id='$id' ORDER by id DESC limit 0,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$price_id=$row1['id'];
		}

$sql = "UPDATE products
        SET gen_name=?, price=?, price2=?, o_price=?, sell_price=?, price_id=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$price,$price2,$o_price,$sell_price,$price_id,$id));

header("location: product.php");


?>
