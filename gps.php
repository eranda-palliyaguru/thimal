<!DOCTYPE html>
<html>
<body>

<p>Get GPS Location Every 5 seconds</p>

<p id="coordinates"></p>

<body onload="getLocation()"> 
 <a href="#" id="1" name="2" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>

	<script type="text/javascript">
$(function() {
$(".delbutton").click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id");
//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {
 $.ajax({
   type: "GET",
   url: "loading_dll.php?yard=<?php echo $yard;?>",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>	
	
	
	
	<script type="text/javascript">
var x = document.getElementById("coordinates");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
	setTimeout(getLocation, 5000);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "https://maps.google.com/?q=" + position.coords.latitude + "," + position.coords.longitude;

}
	

	
</script>

	
	
	

</body>
</html>