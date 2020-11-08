<?php
session_start();
include('connect.php');
$invoice = $_POST['invoice'];
$customer = $_POST['customer'];
$date = $_POST['date'];
$lorry = $_POST['lorry'];


$item = $_POST['item1'];

$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
$term=$row['term'];
$root=$row['root'];
}


// query
$sql = "INSERT INTO sales_order (customer,invoice,root,term,lorry_no,date) VALUES (:a,:b,:root,:term,:lorry_no,:date)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$customer,':b'=>$invoice,':term'=>$term,':root'=>$root,':lorry_no'=>$lorry,':date'=>$date));



$tebal_id1='hold';
$tebal_id2='hold';
$tebal_id3='hold';
$tebal_id4='hold';
$tebal_id5='hold';
$tebal_id6='hold';
$tebal_id7='hold';
$tebal_id8='hold';
$tebal_id9='hold';





$item1 = $_POST['item1'];
$qty1 = $_POST['qty1'];
$item=$item1;
$qty=$qty1;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
$term=$row['term'];
$root=$row['root'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id1=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id1=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));












$item2 = $_POST['item2'];
$qty2 = $_POST['qty2'];
$item=$item2;
$qty=$qty2;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id2=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id2=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));








$item3 = $_POST['item3'];
$qty3 = $_POST['qty3'];
$item=$item3;
$qty=$qty3;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id3=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id3=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));






$item4 = $_POST['item4'];
$qty4 = $_POST['qty4'];
$item=$item4;
$qty=$qty4;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id4=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id4=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));






$item5 = $_POST['item5'];
$qty5 = $_POST['qty5'];
$item=$item5;
$qty=$qty5;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id5=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id5=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));



$item6 = $_POST['item6'];
$qty6 = $_POST['qty6'];
$item=$item6;
$qty=$qty6;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id6=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id6=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));





$item7 = $_POST['item7'];
$qty7 = $_POST['qty7'];
$item=$item7;
$qty=$qty7;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id7=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id7=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));







$item8 = $_POST['item8'];
$qty8 = $_POST['qty8'];
$item=$item8;
$qty=$qty8;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id8=$row['tebal_id'];

}
$sql = "UPDATE sales_order 
        SET $tebal_id8=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));




$item9 = $_POST['item9'];
$qty9 = $_POST['qty9'];
$item=$item9;
$qty=$qty9;
$result = $db->prepare("SELECT * FROM loading WHERE  lorry_no= :userid AND action='load' AND product_name='$item' ");
$result->bindParam(':userid', $lorry);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
}
$sql = "UPDATE loading 
        SET qty=qty-?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));

$result = $db->prepare("SELECT * FROM products WHERE  gen_name= :userid  ");
$result->bindParam(':userid', $item);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$tebal_id9=$row['tebal_id'];

}

$sql = "UPDATE sales_order 
        SET $tebal_id9=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$invoice));





header("location:sales.php");


?>