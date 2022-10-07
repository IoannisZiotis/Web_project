<?php 
	session_start();
	
if(isset($_SESSION['currentdeliver'])) {
?>

<!DOCTYPE html>

<html>
	<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">


			

		//----------------------map------------------------------
		var marker;
		function initAutocomplete() {
		map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: 39.038464, lng: 20.735780},
	          zoom: 13
	    });

	    marker = new google.maps.Marker({
          position: {lat: 38.238464, lng: 21.735780},
          map: map,
          title: 'Your Position',
          draggable:true
        });
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
  		}
  		//---------------------------------------------------------

		$(document).ready(function()
		{
			//----------popup box show----------
			$('#avail').click(function(){
				$('.popupBox').fadeIn('slow');
				
				google.maps.event.trigger(map, 'resize');
				var reCenter = new google.maps.LatLng(38.238464, 21.735780);
				map.setCenter(marker.getPosition());

			});
			$('.close').click(function(){
			$('.popupBox').fadeOut('slow');
			});
			//-----------------------------------

			//------------map submit button--------------			
			$('#popupBoxContent').on('click','#sub',function(){
			var address = $("#pac-input").val();
			var Data = "text="+address;
			$.ajax({    
				type: "POST",
				url: "loc.php",  
				data:Data,
				success: function(response){                  
					location.href =  "orders.php";
					
				}
				});
			});
			//-------------------------------------------
			$('#logout').click(function(){
				$.ajax({    
				type: "POST",
				url: "logout.php",  
				success: function(response){                    
					location.href =  "login.html";
				}
				});
			});
			//-------------address submit button-------------
			$('#popupBoxContent').on('click','#sub_map',function(){
			var lat = marker.getPosition().lat();
			var lng = marker.getPosition().lng();
			var text = lat+" "+lng;
			var Data = "text="+text;
			$.ajax({    
				type: "POST",
				url: "loc1.php",  
				data:Data,
				success: function(response){                 
					location.href =  "orders.php";
				}
				});
			});
			//------------------------------------------------
			$('#info').click(function(){
				$('.infopopupBox').fadeIn('slow');
				$.ajax({    
				type: "POST",
				data: {
			   	user_name:name,
			  	},
				url: "info.php",  
				success: function(response){  
					console.log(response);                 
					$( '#infopopupBoxContent' ).html(response);
				}
				});
			});
			$('.close').click(function(){
			$('.infopopupBox').fadeOut('slow');
			});
		});			

	</script>				
	</head>
	<body>
		<h1>Κεντρική Σελίδα</h1>
		<div class="popupBox">
			<div class="popupBoxWrapper">
				<div id="popupBoxContent">
					<span class="close">&times;</span>
					<h2>Προσδιορίστε την θέση σας στο χάρτη</h2>
					<div id="map"></div>
					<input id='sub_map' value="Confirm" type='submit'>
					<h4>Εναλλακτικά</h4> 
					<h5>Πληκτρολογήστε την διεύθυνση</h5>
					<input id="pac-input" class="controls" type="text" placeholder="Address">
					<input id='sub' value="Confirm" type='submit'>
				</div>
			</div>	
		</div>
		<input id="avail" type=button value="Διαθεσιμότητα" onclick="javascript:void(0)" />
		<div class="infopopupBox">
			<div class="infopopupBoxWrapper">
			<span class="close">&times;</span><br><br>
				<div id="infopopupBoxContent">
				
					
				</div>
			</div>	
		</div>
		<input id="info" value="Πληροφορίες" onclick="javascript:void(0)" type="button" />
		<input id="logout" type="button" value="Έξοδος" action="/logout.php"/>	
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKeLIlgJ6RmiJ0nTi0kZb4Oixc5MN9MpQ&libraries=places&callback=initAutocomplete">
		</script>			
	</body>
</html>
<?php
}
	else
	echo "<p style='font-size:250%;text-align:center;'>You are not logged in, log in ","<a href='login.html'>here</a></p>";
	?>