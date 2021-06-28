<!DOCTYPE html> 
<html lang="en-US"> 
<head> 
<title>SPACE-O :: Get Visitor Location using HTML5</title> 

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

url:'customer_gps_set.php', 

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

</head> 

<body> 

    <p><span class="label">Your Location:</span> <span id="location"></span></p> 

</body> 

</html>