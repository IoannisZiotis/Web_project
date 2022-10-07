
<?php
include "data_connect.php";
mysqli_set_charset( $conn,'utf8');
session_start();
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCNUZ_YMZEz1CJK-QJprZtTM3jpQWn95b4"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="orders.css" />
		<script type="text/javascript" src="ng-map.js" ></script>
		
		<meta name="keywords" content="ng-map,AngularJS,center">
		<meta charset=utf-8>
		<script>
		var name = '<?php echo $_SESSION['currentdeliver']; ?>' ;
		$(document).ready(function(){
			    $("#deliver").click(function(){
			        $.ajax({
					  type: 'post',
					  url: 'delivered.php',
					  data: {
					   user_name:name,
					  },
					  success: function (response) {

					   location.reload(); 
					  }
					  });
					  
			});
			$("#un").click(function(){
			        $.ajax({
					  type: 'post',
					  url: 'unavailable.php',
					  success: function (response) {
					   window.location = "Deliver.php"; 
					  }
					  });
			    });
		});
		</script>
	</head>
	<body>
	<div ng-app="myApp" ng-controller="customersCtrl" ng-cloak>
	
		<div  id='wrapper' >
				<p><strong>Καμία Παραγγελία...</strong><p><br>
				<button id="un">Μη Διαθέσιμος</button>
			</div>
		<div class="container" >
		<div class="item"  id="address">
			
		<h2>Παραγγελία</h2>
			<table class="rwd-table">
			<caption><h3>Κατάστημα</h3></caption>
				<tr>
					<th>Διεύθυνση</th>
					<th>Αριθμός</th>
					<th>Πόλη</th>
					<th>Όνομα</th>
				</tr>
				<tr>
					<td>{{ address.Address }}</td>
					<td>{{ address.Address_number }}</td>
					<td>{{ address.City }}</td>
					<td>{{ address.Store_name }}</td>
				</tr>
			</table>
		</div>
		<div class="item" id="destination">
		<table class="rwd-table">
		<caption><h3>Πελάτης</h3></caption>
			<tr>
				<th>Διεύθυνση</th>
				<th>Αριθμός</th>
				<th>Πόλη</th>
			</tr>
			<tr>
				<td>{{ Address.Address }}</td>
				<td>{{ Address.Address_number }}</td>
				<td>{{ Address.City }}</td>
			</tr>
		</table>
	</div>
<div id="map_const">
	<ng-map  zoom="10" center="[{{lat}}, {{lon}}]" style="width:100%;height:50%;">
		<marker position="[{{lat}}, {{lon}}]" />
		<control name="overviewMap" opened="true" />
	</ng-map>
	</div>
	<div class="item" id="order"  >
		<table class="rwd-table">
		<caption><h3>Προϊόντα</h3></caption>
			<tr ng-repeat="(x,i) in products">
			<th>{{ x }}</th>
			<td>{{ i }}</td>
			</tr>
		</table>

	</div>
	<input id="deliver" type="button" value="Deliver"/>
		
	</div>
	 

		<script>
		
		var app = angular.module('myApp', ['ngMap']);
		app.controller('customersCtrl',["$scope","$http","$interval","$window", function($scope, $http,$interval,$window) {
			$scope.flag=false;
			$scope.x =function(){
			$http({
				method:"POST",
				url:"get_shop.php"
			}).then(function success(data){
				// console.log(data);
				$scope.address=data['data'];
				// console.log($scope.flag);
			});
			$http({
				method:"POST",
				url:"get_cust.php"
			}).then(function success(data){
				// console.log(data);
				$scope.Address=data['data'];

				// console.log($scope.flag);
			});
			
			$http({
				method:"POST",
				url:"load_order.php"
			}).then(function success(data){
				// console.log(data);
				$scope.order = data['data'];

				$scope.products={};
				var j=0;
				for (var i in $scope.order){
					if ($scope.order[i]!=0){
						$scope.products[i]=$scope.order[i];
					}
					else
						j++;
				}

			});
			$http({
				method: 'post',
				url: 'get_cust.php'
				}).then(function success(response){
				{
					// console.log(response);
					$scope.data=response['data'];
					// console.log($scope.data);
					$scope.latlng=$scope.data['lnglat'];
					// console.log($scope.latlng);
					$scope.point =$scope.latlng.split(" ");
					$scope.lat=parseFloat($scope.point[0]);
					$scope.lon=parseFloat($scope.point[1]);
				}
				});
			}
			
			 $scope.check_orders = function(){$http({
			 	method: "POST",
			 	url: "check_orders.php"
			 	}).then(function success(data){
					//  console.log(data);
			 			if (data['data']<=0){
							 $("#wrapper").show();
			 				$(".container").hide();
						}
			 			else{
							 if (!$(".container").is(":visible"))
							 	$(".container").hide();
							$("#wrapper").hide();
							$(".container").show();
							
							$scope.x();
							
						}
					});
				 };
				
				$interval($scope.check_orders,10000);
				
				
			
				
			}]);		
	</script>
	
	
	
	<body>

</html>




