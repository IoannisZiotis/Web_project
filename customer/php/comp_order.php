<?php
session_start();
 if(isset($_SESSION['currentuser'])) {
?> 

<!DOCTYPE html>

<html>
<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/compstyle.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Vollkorn" />
	<script type="text/javascript" src="../js/cust_exit.js"></script>
	<script type="text/javascript">

	
$(document).ready(function(){
	$('.dropbtn').click(function(){
		$('#exit_btn').slideToggle();   
	});
	
});

	</script>
</head>
<body>
<div id="header" >
	<button href="javascript:void(0)" class="dropbtn"><?php echo $_SESSION['currentuser']; ?></button>
	</div>
	<button id="exit_btn" onclick="exit()">Αποσύνδεση</button>
	<div class="test" ng-app="App" ng-controller="Controller" ng-cloak>
		<div id="wrapper">
			<div id="popupBoxContent">
				<h2>Επιλέξτε την διεύθυνση σας</h2>
				<div id="map"></div>
				<a style="text-decoration:none;" href="#summ"><input id='sub_map' value="Confirm" type='submit' ng-click="get_loc();getDistance();" ></a>
				<h4>Εναλλακτικά</h4>
				<h5>Πληκτρολογήστε την διεύθυνση</h5>
				<input id="pac-input" class="controls" type="text" placeholder="Address" >
				<a style="text-decoration:none;" href="#summ"><input id='sub' value="Confirm" type='submit' ng-click="get_addr();codeAddress();" ></a>
			</div>
				
				<div id="summ">
					
					<h2> Τα στοιχεία σας</h2>
					<div class="summ_content" > Διεύθυνση:
						{{addr}}
					</div>
					<div class="summ_content"> Τηλέφωνο:
						{{phone}}
					</div>
					<div class="summ_content">
						<table id="f_order">
							<tr>
								<th>Προϊόν</th>
								<th>Ποσότητα</th>
								<th>Διαθεσιμότητα</th>
							</tr>
							<tr ng-repeat="(x,y) in list2">
								<td>{{x}}</td>
								<td>{{y}}</td>
								<td>{{available[x]}}</td>
							</tr>
						</table>
					</div>
					<div class="summ_content" id="sss">
						Σύνολο:
						{{cost}}&euro;
					</div>
					<div id="fin">
						<button id="fin_btn" ng-disabled="btnDisabled" ng-click="comp_order()">Αποστολή Παραγγελίας</button>

					</div>
					<div id="message">Παρακαλώ δώστε τη διεύθυνση σας!</div>
					<div id="del_mess"></div>
				</div>
			</div>
		</div>
		<script async type="text/javascript" src="../js/comp_order.js"></script>
		<script 
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrC7lPL7i85pO4hqe6PKFJLjqJsKnWJcU&libraries=places" defer>
	</script>
	
</body>

</html>

<?php
}
	else
	echo "<p style='font-size:250%;text-align:center;'>You are not logged in, log in ","<a href='../index.php'>here</a></p>";
?>
