var app = angular.module("myApp", ['ngAnimate']);
app.controller("myController",["$scope", "$http",function($scope,$http) {
	
	// $.ajax({
	// 	type:"GET",
	// 	url:"../php/get_info.php",
	// 	dataType:'json',
	// 	success: function(data)
	// 	{
	// 		alert(data);
			
	// 		$scope.prices = {}
	// 		for(var key in q)
	// 		{
	// 			$scope.prices[key] = Number(data[key]);
	// 		}
	// 		$scope.$digest();
	// 	}
	// });

	$http.get("../php/get_info.php").then(function(data){
		
		$scope.prices = {}
		$scope.products = Object.assign({},$scope.coffees_eng, $scope.small_meals_eng)
		for(var key in $scope.products)
		{
			console.log(key)
			$scope.prices[key] = Number(data['data'][key]);
			
		}
		
	});

	$http({
		method:'GET',
		url:"../php/customer_info.php"
	}).then(function succ(data){
		
		$scope.cust_phone = data['data'];
	});
	$scope.pl = String.fromCharCode(10010),
	$scope.rem =String.fromCharCode(10008),
	$scope.min =  String.fromCharCode(10134),
	$scope.small_meals = {
		"Τυρόπιτα":1,
		"Χορτόπιτα":1,
		"Κέικ":1,
		"Τόστ":1,
		"Κουλούρι":1,
	};
	$scope.test = 1,
	$scope.coffees = {
		"Ελληνικός":1,
		"Φραπέ":1,
		"Εσπρέσο":1,
		"Καπουτσίνο":1,
		"Φίλτρου":1,
	};

	$scope.small_meals_eng = {
		"tiropita":1,
		"Xortopita":1,
		"keik":1,
		"tost":1,
		"koulouri":1,
	};
	$scope.coffees_eng = {
		"Ellinikos":1,
		"frape":1,
		"espresso":1,
		"Kapoutsino":1,
		"filtrou":1,
	};
	
	$scope.save = function(){
		var data = $scope.quantities;
		$.ajax({
			type:"POST",
			url:"../php/update_quant.php",
			data:data,
			success(response)
			{
				// console.log("success");
			}
		});
	};
	$scope.list = {};
	$scope.add = function(id){

		if (!(id in $scope.list))
		{
			if (id in $scope.small_meals_eng)
				$scope.list[id] = $scope.small_meals_eng[id];
			else
				$scope.list[id] = $scope.coffees_eng[id];
		}
		else
		{
			$scope.list[id] += 1;
		}
	}
	$scope.increment = function(id){
		$scope.list[id]++;
	};
	$scope.decrement = function(id){

		if ($scope.list[id]==1)
			$scope.remove(id);
		else if ($scope.list[id]>1)
			$scope.list[id]--;
	};
	$scope.remove = function(id){
		delete $scope.list[id];
	};
	
	$scope.totalcost = function(){
		var c =0.0;

		for(key in $scope.list)
			c += $scope.list[key] * $scope.prices[key];
		if(Number(c)>0)
		{
			$("#is_empty").hide();
		}
		return (c.toFixed(2));
	};
	$scope.isempty =function(){
		var s;
		if (angular.equals($scope.list, {})){
			s = "Το καλάθι σου είναι άδειο! ";
			return s;

		}
	};
	$scope.in = function(){
		if
			(Number($scope.totalcost())===0){
				$("#is_empty").show();
			}
			else{
			if (typeof(Storage) !== "undefined") {
    // Store
    sessionStorage.setItem('list', JSON.stringify($scope.list));
    sessionStorage.setItem('phone', JSON.stringify($scope.cust_phone));
    sessionStorage.setItem('cost',JSON.stringify($scope.totalcost()));
    // Retrieve
} else {
	console.log("bad");
}
window.location = "../php/comp_order.php";
		}
	}
	$scope.size = function(){
		var i =0;
		for(var j in $scope.list)
			i++;
		return i;
	}


}]);
