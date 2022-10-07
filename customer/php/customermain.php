
<?php
session_start();
if (isset($_SESSION['currentuser'])){
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/customer_st.css" type="text/css" media="all" /> <!-- Style-CSS -->

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Vollkorn" />
	<link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
	<script type="text/javascript" src="../js/cust_exit.js"></script>
<script>
$(document).ready(function(){
	$('.dropbtn').click(function(){
		if ($('#exit_btn').is(":visible"))
			$('#exit_btn').hide();
		else
			$('#exit_btn').show();
	});
	
});
</script>
</head>

<body ng-app="myApp" ng-Controller="myController" ng-cloak>

	<div id="header" ><button href="javascript:void(0)" class="dropbtn"><?php echo $_SESSION['currentuser']; ?></button>
		<input style="width:25px;-webkit-margin-end: -38px;height:25px;background-color:yellow;border-radius:50%;z-index:10;-moz-margin-end: -38px;margin-top:3px;" value="{{size()}}" disabled type="text">
		<a id="#cart_logo" href="#right_container"><img src="../images/cart.png"></a>
	</div>
	<button id="exit_btn" onclick="exit()">Αποσύνδεση</button>
	<div id="wrapper" >
	
		<div id="left_sect">
			
			<div id="food_cont" >
				<div>
					<ul>
					<li id="list_title"><h2>Μικρογεύματα</h2></li>
						<li ng-click=add(meal) ng-repeat="(meal,x) in small_meals_eng" >{{meal}}<a href="javascript:void(0)" >{{prices[meal]}}&euro;</a></li>
					</ul>
				</div>
			</div>
			
			<div id="drink_cont" >
				<div>
					<ul>
					<li id="list_title"><h2>Καφές</h2></li>
						<li ng-click=add(cof) ng-repeat="(cof,x) in coffees_eng" >{{cof}}<a class="pr_i" href="javascript:void(0)" >{{prices[cof]}}&euro;</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="right_container">
			<table >
				<tr>
					<th colspan ="3" >Η ΠΑΡΑΓΓΕΛΙΑ ΣΑΣ</th>
				</tr>
				<tr ng-repeat="(x,y) in list">
					<td><button ng-click="remove(x)" class="rem_btn" >
						{{rem}}
					</button></td>
					<td>{{x}}</td>
					<td id="res">
						<button ng-click="decrement(x)" class="minus_btn" >
							{{min}}
						</button>
						<input type="text" id="quantity" disabled value={{y}}>
						<button ng-click="increment(x)" class="plus_btn">
							{{pl}}
						</button>
					</td>
				</tr>
			</table>
			<div id="empty">
				{{isempty()}}
			</div>
			<div id="price">
				Σύνολο <br> {{totalcost()}}&euro;
			</div>
			<div id="basket" ng-click="in()" >
				Ολοκλήρωση Παραγγελίας
			</div>
			<div id="is_empty" >
				Επέλεξε κάτι για να συνεχίσεις με την ολοκλήρωση της παραγγελιας σου.
			</div>
			</div>
		
		<script type="text/javascript" src="../js/customer.js"></script>
	</body>

	</html>

<?php
}
	else
	echo "<p style='font-size:250%;text-align:center;'>You are not logged in, log in ","<a href='../index.php'>here</a></p>";
?>