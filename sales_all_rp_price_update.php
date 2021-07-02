<?php

//$dealer_v=0;$dealer1_v=0; $dealer_qty_v=0;$dealer_qty1_v=0; $sell_v=0;$sell_val_v=0;  $dis_v=0;$dis_val_v=0;

            $pid=$row1122['id'];
            $up_date=$row1122['date'];
            $up_price2=$row1122['d_price2'];
            $up_price=$row1122['d_price'];
            $o_price=$row1122['o_price'];



if ($up_price==$up_price2) {
  //---------------------------------------------------------- OLD price 2nd table--------------------------------------------------------------------------//

  //--- Kaluthara ----//
              $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='$pid' AND price='$up_price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
              $result->bindParam(':userid', $invo);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){ $dealer_qty+=$row['sum(qty)'];$dealer_qty_v=$row['sum(qty)']; }



              $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='$pid' AND price='$up_price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
              $result->bindParam(':userid', $invo);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){ $dealer+=$row['sum(amount)']; $dealer_v=$row['sum(amount)'];}

              $ma=$o_price*$dealer_qty_v;
              $dealer_m+=$dealer_v-$ma;


  //----------------------------------------------------------------Colombo-----------------------------------------------------------
              $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND area < '2' AND  price_id='$pid' AND price='$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
              $result->bindParam(':userid', $invo);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){ $dealer_qty1+=$row['sum(qty)']; $dealer_qty1_v=$row['sum(qty)'];}


              $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND area < '2' AND  price_id='$pid' AND price='$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
              $result->bindParam(':userid', $invo);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){ $dealer1+=$row['sum(amount)']; $dealer1_v=$row['sum(amount)']; }


              $ma1=$o_price*$dealer_qty1_v;
              $dealer_m1+=$dealer1_v-$ma1;



}else {





//---------------------------------------------------------- OLD price 2nd table--------------------------------------------------------------------------//

//--- Kaluthara ----//
            $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price='$up_price2' AND  price_id='$pid' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dealer_qty+=$row['sum(qty)'];$dealer_qty_v=$row['sum(qty)']; }



            $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price='$up_price2' AND  price_id='$pid' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dealer+=$row['sum(amount)']; $dealer_v=$row['sum(amount)'];}

            $ma=$o_price*$dealer_qty_v;
            $dealer_m+=$dealer_v-$ma;


//----------------------------------------------------------------Colombo-----------------------------------------------------------
            $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price='$up_price' AND  price_id='$pid' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dealer_qty1+=$row['sum(qty)']; $dealer_qty1_v=$row['sum(qty)'];}


            $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price='$up_price' AND  price_id='$pid' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dealer1+=$row['sum(amount)']; $dealer1_v=$row['sum(amount)']; }


            $ma1=$o_price*$dealer_qty1_v;
            $dealer_m1+=$dealer1_v-$ma1;
}









//----------------------------------------------------------------Selling-----------------------------------------------------------
            $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price > '$up_price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $sell+=$row['sum(qty)'];$sell_v=$row['sum(qty)']; }

            $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price > '$up_price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $sell_val+=$row['sum(amount)']; $sell_val_v=$row['sum(amount)']; }


//--------------------------------------------------------------- Discount-----------------------------------------------------------
            $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price < '$up_price2' AND price > '$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $sell+=$row['sum(qty)']; $sell_v1=$row['sum(qty)']; }

            $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price < '$up_price2' AND price > '$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $sell_val+=$row['sum(amount)'];  $sell_val_v1=$row['sum(amount)']; }

            $sell_v=$sell_v1+$sell_v;
            $sell_val_v=$sell_val_v1+$sell_val_v;

            $ma3=$o_price*$sell_v;
            $sell_m+=$sell_val_v-$ma3;

            $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price < '$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dis+=$row['sum(qty)']; $dis_v=$row['sum(qty)']; }

            $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='$pid' AND  price < '$up_price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
            $result->bindParam(':userid', $invo);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $dis_val+=$row['sum(amount)']; $dis_val_v=$row['sum(amount)']; }


            $dis_m1+=($up_price*$dis_v)-($o_price*$dis_v);
            $dis_m+=$dis_val_v-($up_price*$dis_v);

 ?>
