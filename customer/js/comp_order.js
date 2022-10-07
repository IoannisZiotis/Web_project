
var app = angular.module("App", ['ngAnimate']);
app.controller("Controller",["$scope","$window","$http","$interval", function($scope,$window,$http,$interval) {

	$scope.cost = $.parseJSON(sessionStorage.getItem('cost'));
	$scope.list = $.parseJSON(sessionStorage.getItem('list'));
	$scope.list2 = $.parseJSON(sessionStorage.getItem('list'));
	$scope.phone = $.parseJSON(sessionStorage.getItem('phone'));
	// $scope.pr_lat = $.parseJSON(sessionStorage.getItem('lat'));
	// $scope.pr_lng = $.parseJSON(sessionStorage.getItem('lng'));
	$scope.addr = "";
	$scope.get_addr = function(){

		$scope.addr = $("#pac-input").val();
		// console.log($("#pac-input").val());

	};

	$scope.r_name;
	$scope.r_num;

	$scope.get_road = function($r_num,$r_name){
		$scope.r_num = $r_num;
		$scope.r_name = $r_name;
	};

	$scope.origins = [];
	$scope.dests=[];

	// $scope.get_phone = function(){
	// 	$scope.phone = $("#phone_num").val();
	// }


	$window.initMap = function () {

		geocoder = new google.maps.Geocoder();
		// $scope.get_pr_addr();
		$scope.map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 38.245128,lng: 21.733832},
			zoom: 13
		});


		$scope.marker = new google.maps.Marker({
			position: {lat: 38.245128, lng: 21.733832},
			map: $scope.map,
			title: 'Your Position',
			draggable:true
		});
		
		var input = document.getElementById('pac-input');
		var searchBox = new google.maps.places.SearchBox(input);
		$scope.directionsService = new google.maps.DirectionsService();
		$scope.service = new google.maps.DistanceMatrixService;
	};

	
	$http({

		method:'POST',
		url:"../php/store_info.php"
	}).then(function succ(data){
	

		$scope.info = data['data'];
	});



	$scope.dists = [];
	$scope.dists2 = [];
	$scope.available = [];
	for(var i in $scope.list)
	{
		$scope.available[i] = "Ναι";
	}
	
	$scope.del_dist = [];
	$scope.origins2 =[];
	$scope.dests2 =[];
	console.log($scope.origins);
		console.log($scope.dests);
	$scope.find_closest_del = function(){
		$scope.service.getDistanceMatrix({
			origins: $scope.origins2,
			destinations: $scope.dests2,
			travelMode: 'DRIVING',
			unitSystem: google.maps.UnitSystem.METRIC,
			avoidHighways: false,
			avoidTolls: false
		}, function(response, status) {
			if (status !== 'OK') {
				alert('Error was: ' + status);
			} else {
				var originList = response.originAddresses;
				var destinationList = response.destinationAddresses;
				var results = response.rows[0].elements;
				// console.log($scope.dists2);
				
				for(var i in $scope.del_info){
					$scope.dists2.push({ "name":$scope.del_info[i].Name,"dist":Number(results[i].distance.value)});

				}

				$scope.dists2.sort(function(a, b) {
					return a.dist - b.dist;

				});
				// $scope.comp_order();
			}
		});
	};
	$scope.check = function(){
		if ($scope.addr=="" )
			$("#message").show();
		else
			$("#message").hide();
	};
	$interval($scope.check,3000);
	$scope.comp_order = function(){
		if ($scope.addr=="" )
		{
			// $("#message").show();
		}
		else
		{

			$("#message").hide();
			$scope.list['store_name'] = $scope.dists[0].name;
			$scope.list['del_name']=$scope.dists2[0].name;
			$scope.list['r_num'] = $scope.r_num;
			$scope.list['r_name'] = $scope.r_name;
			$scope.list['r_city'] = $scope.r_city;
			$scope.list['phone'] = $scope.phone;
			$scope.list['price'] = $scope.cost;

			$http({

				method:'POST',
				url:"../php/create_order.php",
				data:$scope.list

			}).then(function succ2(data2){
				alert("Η παραγγελία σας ολοκληρώθηκε επιτυχώς!");
				window.location = "../index.php";
			});
		}

	};


	$scope.get_del_info = function(){

		$http({

			method:'POST',
			url:"../php/delivery_info.php"

		}).then(function succ(data){

			$scope.del_info = data['data'];
			$scope.origin2 = new google.maps.LatLng($scope.dists[0].Lat, $scope.dists[0].Long);

			for(var i in $scope.del_info)
			{	
				var or = new google.maps.LatLng($scope.addr_lat, $scope.addr_long);
				var dest = new google.maps.LatLng($scope.del_info[i].Lat,$scope.del_info[i].Long );
				$scope.dests2.push(dest);
				$scope.origins2.push(or);
			}
			if($scope.del_info.length==0)
			{
				$('#del_mess').html('No Delivery Available');
				$('#del_mess').show();
				$scope.btnDisabled = true;
				$("#fin_btn").css("cursor","not-allowed");
			}
			else{
				$('#del_mess').hide();
				$scope.find_closest_del();
				}

		});
	}


	$scope.get_loc = function(){
		var lat = $scope.marker.getPosition().lat();
		var lng = $scope.marker.getPosition().lng();
		$scope.addr_lat = lat;
		$scope.addr_long = lng;
		var new_addr;
		var latlng = {lat: lat, lng: lng};
		geocoder.geocode( { 'location': latlng}, function(results, status) {
			if (status == 'OK') {

				console.log(results[0].address_components[0].long_name);

				$("#pac-input").val(results[0].formatted_address);
				$scope.addr = results[0].formatted_address;
				$scope.get_addr();
				$scope.get_road(results[0].address_components[0].long_name,results[0].address_components[1].long_name);
				// console.log("results",results[0]);
				var addr_el = results[0].address_components;
				for(var i in addr_el )
				{
					if(addr_el[i].types[0]=='locality')
					{
						$scope.r_city = addr_el[i].long_name;
						break;
					}
				}
				// console.log($scope.r_city);
				$scope.$digest();
				

			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}



		});


	}



	$scope.codeAddress = function(){
		var address = $scope.addr;
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == 'OK') {
				console.log(results[0].geometry.location);
				$scope.addr_lat = results[0].geometry.location.lat();
				$scope.addr_long = results[0].geometry.location.lng();
				$scope.map.setCenter(results[0].geometry.location);
				$scope.marker.setPosition(results[0].geometry.location);
				$scope.getDistance();

			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}

		});
	};


	$scope.getDistance = function(){
		$scope.directionsService = new google.maps.DirectionsService();
		$scope.origin = new google.maps.LatLng($scope.addr_lat, $scope.addr_long);
		$scope.store_dist = [];
		 console.log($scope.info);
		for(var i in $scope.info)
		{	
			var or = new google.maps.LatLng($scope.addr_lat, $scope.addr_long);
			// console.log("origin");
			// console.log($scope.addr_lat,$scope.addr_long);
			var dest = new google.maps.LatLng($scope.info[i].Lat,$scope.info[i].Long );
			// console.log("DESTINATION");
			// console.log($scope.info[i].Lat,$scope.info[i].Long);
			$scope.dests.push(dest);
			$scope.origins.push(or);
		}
		console.log($scope.origins);
		console.log($scope.dests);
		// console.log($scope.addr_lat);
		// console.log($scope.addr_long);

		$scope.service.getDistanceMatrix({
			origins: $scope.origins,
			destinations: $scope.dests,
			travelMode: 'DRIVING',
			unitSystem: google.maps.UnitSystem.METRIC,
			avoidHighways: false,
			avoidTolls: false
		}, function(response, status) {
			if (status !== 'OK') {
				alert('Error was: ' + status);
			} else {

				var originList = response.originAddresses;
				var destinationList = response.destinationAddresses;
				var results = response.rows[0].elements;
				console.log(results);
				for(var i in $scope.info){
					$scope.dists.push({ "name":$scope.info[i].Name,"dist":Number(results[i].distance.value)});
					// console.log(results[i].distance.value);
					// console.log($scope.dists);
				}
				$scope.dists.sort(function(a, b) {
					return a.dist - b.dist;
				});
				if($scope.dists[0].dist>5000)
				{
					alert("Βρίσκεστε πολυ μακρια και δεν σας εξυπηρετεί κανένα κατάστημα");
				}
				else
				{	
					var text ="Τα ακόλουθα προϊόντα που επέλεξες δεν είναι διαθέσιμα: ";
					var k=0;
					var s;
				
					for(var i in $scope.info)
					{
						if($scope.info[i].Name==$scope.dists[0].name)
						{
							s=i;
							break;
						}
					}
					var cl_store=$scope.info[s];
					$scope.btnDisabled =true;
					for(var i in $scope.list)
					{
					
						if(i!="Ελληνικός" && i!="Φραπέ" && i!="Εσπρέσο" && i!="Καπουτσίνο" && i!="Φίλτρου")
						{
							if(Number(cl_store[i])<$scope.list[i])
							{
								$scope.available[i] = "Οχι";
								text+=i;
								k+=1;
							}
						}
					}
					if(k>0){
						
						$scope.btnDisabled = true;
						$("#fin_btn").css("cursor","not-allowed");
					}
					else{
						$scope.btnDisabled = false;
						$("#fin_btn").css("cursor","pointer");
						$scope.get_del_info();
					}
				}
			}
			}
		);
	}
	initMap();
}]);

