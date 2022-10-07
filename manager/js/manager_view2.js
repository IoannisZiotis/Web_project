




var app = angular.module("myApp", ['ngAnimate']);
app.controller("myController",["$scope","$http","$interval",function($scope,$http,$interval) {

	$scope.get_quant = function(){
		$.ajax({
			type:"POST",
			url:"../php/get_quantities.php",
			success: function(data)
			{
				var q = $.parseJSON(data);
				var q2 = q[0];
				var quantities = {
					"Κέικ":q2.κέικ,
					"Κουλούρι":q2.κουλούρι,
					"Τόστ":q2.τοστ,
					"Τυρόπιτα":q2.τυρόπιτα,
					"Χορτόπιτα":q2.χορτόπιτα
				};
				$scope.quantities = quantities;
				$scope.$digest();
			}
		})
	};
	$scope.get_quant();
	// $scope.$digest();
	$scope.get_orders = function(){$http({
		method: "POST",
		url: "../php/display.php"
	}).then(function sucess(data){

		var p = data['data'];
		// console.log(p);
		var orders ={};
		if (p.length==0)
		{
			
			$("#order_table").hide();
			$("#empty").show();

		}
		else
		{
			if (!$("#order_table").is(":visible"))
			{
				$("#order_table").slideToggle();
			}
			$("#rwd-table").show();
			$("#empty").hide();
		}
		for(var i=0;i<p.length;i++)
		{
			console.log("price: ");
			console.log(Number(p[i].price));
			if (i<=9)
			{
				var products = {Τυρόπιτα:Number(p[i].τυρόπιτα),
					Χορτόπιτα:Number(p[i].χορτόπιτα),
					Κέικ:Number(p[i].κέικ),
					Τόστ:Number(p[i].τοστ),
					Κουλούρι:Number(p[i].κουλούρι),
					Φραπέ:Number(p[i].φραπέ),
					Εσπρέσσο:Number(p[i].εσπρέσο),
					Καπουτσίνο:Number(p[i].καπουτσίνο),
					Ελληνικός:Number(p[i].ελληνικός),
					Φίλτρου:Number(p[i].φίλτρου)
				};
			}

			orders[p[i].id]=new order(products,p[i].address,
				p[i].number,p[i].phone,p[i].price,p[i].id);

		}

		$scope.orders = orders;
			// $scope.$digest();
		})
};
// setTimeout($scope.get_orders,3000);
$interval($scope.get_orders,6000);
// setTimeout($scope.$digest(),3000);

$scope.tick =  String.fromCharCode(10004),
$scope.products = [
"Κέικ",
"Κουλούρι",
"Τόστ",
"Τυρόπιτα",
"Χορτόπιτα",
],

$scope.edit = function(id,val) {
	$scope.quantities[id] = angular.copy(val);
};

$scope.increment = function(id){
	$scope.quantities[id]++;
};

$scope.decrement = function(id){
	if ($scope.quantities[id]>0)
		$scope.quantities[id]--;
};

$scope.save = function(){
	var data = $scope.quantities;
	$.ajax({
		type:"POST",
		url:"../php/update_quant.php",
		data:data,
		success(response)
		{
			alert("success");
		}
	})
}

$scope.delivered = function(id){
	var order_id = id;
	delete $scope.orders[id];
	console.log($scope.orders);
	$http.post("../php/delete_order.php",{"order_id":id}).then(function succ(data){
			// console.log(data);
			var l = Object.keys($scope.orders).length;
			if (l==0){
				$scope.order = false;
			}
			// console.log($scope.order);
		})
}
$scope.get_info  = function(id){
	$scope.info={};
	$scope.info_id = id;
	var order_info = $scope.orders[id].products;
	// console.log(order_info);
	for (var i in order_info)
	{
		console.log(i,":",order_info[i]);
		if (order_info[i]>0)
		{
			// console.log(order_info[i]);
			$scope.info[i] = order_info[i];
		}
	}
	// $scope.info = $scope.orders[id].products;
}



}]);
