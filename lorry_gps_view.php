
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 

<script> 

$(document).ready(function(){ 

    if (navigator.geolocation) { 

        navigator.geolocation.getCurrentPosition(showLocation); 

    } else { 

        $('#location').html('Geolocation is not supported by this browser.'); 

    } 

}); 

function showLocation(position) { 

    var latitude = position.coords.latitude; 

var longitude = position.coords.longitude; 

     

$.ajax({ 

type:'POST', 

url:'lorry_gps_save.php', 

data:'l='+latitude+'&q='+longitude, 

success:function(msg){ 

            if(msg){ 

               $("#location").html(msg); 

            }else{ 

                $("#location").html('Not Available'); 

            } 

} 

}); 

} 

</script> 

<style type="text/css"> 

p{ border: 2px dashed #009755; width: auto; padding: 10px; font-size: 18px; border-radius: 5px; color: #FF7361;} 

    span.label{ font-weight: bold; color: #000;} 

</style> 



<body> 

    <p><span class="label">Your Location:</span> <span id="location"></span></p> 

</body> 


<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>


<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("connect.php");
$id=$_SESSION['SESS_MEMBER_ID'];

$result = $db->prepare("SELECT * FROM user WHERE id='$id' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ul=$row['l'];
				$uq=$row['q'];
				}


$result = $db->prepare("SELECT * FROM customer WHERE q='$uq' AND l='$ul' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				

?>
    <div class="col-md-3 ">
          <div class="info-box">
           <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span  style="font-size: 25px"><?php echo $row['customer_name']; ?><a href="sales.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-lg "> <button type="button" class="btn btn-block btn-primary btn-lg">Add Bill</button></a></span>
              <span class="info-box-number">
				</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<?php } ?>