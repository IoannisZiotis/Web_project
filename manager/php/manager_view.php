

<?php

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Managing Products and Orders</title>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="../css/manager_view.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>

	<script type="text/javascript">
		class order{
			constructor(products={
				cp:0,
				xp:0,
				c:0,
				tost:0,
				koulouri:0,
				frape:0,
				esp:0,
				cap:0,
				gr:0,
				fl:0
			},address,number,phone,price,id)
			{
				this.products  = products;
				this.address = address;
				this.number = number;
				this.phone = phone;
				this.price = price;
				this.id =id;
			}
		}

		$(document).ready(function(){
			$(".dropbtn").click(function(){
				if ($("#logout_btn").is(":visible"))
				{
					$("#logout_btn").hide();
				}
				else
				{
					$("#logout_btn").show();

				}
			});

			$("#order_table").on("click",".info_button",function(){
				$("#order").show();
			});
			$("#order").on("click","#eee",function(){
				$("#order").hide();
			});

			$(".dropdown").on("click","#logout_btn",function(){
				$.ajax({
					type:"POST",
					url:"../php/logout.php",
					success: function(data)
					{
						window.location = '../logout.html';
					}
				})
			});
			$.ajax({
					type:"POST",
					url:"../php/get_store.php",
					success: function(data)
					{
						$('#store').html(data);
					}
				})
			
		});
	</script>
	
</head>
<body>

	<ul id="header">
		<li id="store" style="font-size:200%;float:left;margin-top:5px;"></li>
		<li><button href="javascript:void(0)" class="dropbtn"  ><?php echo $_SESSION['currentmanager']; ?><img src="../css/icon.jpg"/></button>
			<ul class="dropdown">
				<li><button id="logout_btn" >Log out</button></li>
			</ul>
		</li>
	</ul>

	<div ng-app="myApp" ng-controller="myController" class="body" ng-cloak>

		<div id="left_container">
			<button class="btn btn-primary generatetext" id='manage_products' ng-click="manage_quant=!manage_quant;get_quant()" >Διαχείρηση ποσότητας</button>

			<table id="quantity_table" ng-show="manage_quant">
				<tr id="tbl_header">
					<th>Προϊόν</th>
					<th>Ποσότητα</th>
				</tr>
				<tr ng-repeat="(x,y) in quantities">
					<td>{{x}}</td>
					<td>
						<button ng-click="decrement(x)"
						class="btn btn-default btn-number" data-type="minus">
						<span class="glyphicon glyphicon-minus">
						</span>
					</button>
					<input type="text" id="quantity"  ng-change="edit(x,y)" ng-model="y" >
					<button ng-click="increment(x)" class="btn btn-default btn-number" data-type="plus">
						<span class="glyphicon glyphicon-plus"></span>
					</button></td>
				</tr>
			</table>
			<button class="save_changes btn btn-primary generatetext" ng-show="manage_quant" ng-click="save()">Ενημέρωση/Αποθήκευση</button>
		</div>        

		<div  id="right_container"> 
		 <table id="order_table"  >
			<h3>Οι παραγγελίες του καταστήματος σας</h3>
			<tr id="columns">
				<th>Κωδικός Παραγγελίας</th>
				<th>Διεύθυνση</th>
				<th>Τηλέφωνο</th>
				<th>Τιμή</th>
				<th>Πληροφορίες</th>
			</tr>

			<tr ng-repeat="(z,o) in orders" >
				<td>{{o.id}}</td>
				<td>{{o.address+" "+o.number}}</td>
				<td>{{o.phone}}</td>
				<td>{{o.price}}
				<td><button id="{{z}}" class="info_button btn btn-primary generatetext" ng-click="get_info(z);dis=!dis">Info</button>
			</tr>
		</table>	
		<div class="item" id="order"  >
			<table id="rwd-table" >
				<th>Κωδικός Παραγγελίας</th>
				<td>{{info_id}}</td>
				<tr style="color:red;">
					<th>Προϊόν</th>
					<th>Ποσότητα</th>
				</tr>
				<tr ng-repeat="(x,i) in info" >
					<th>{{ x }}</th>
					<td>{{ i }}</td>
				</tr>
				<td colspan="2"><button class="btn btn-default btn-number" data-type="minus" id="eee" ><span class="glyphicon glyphicon-remove" ></span></button></td>
			</table>

		</div>


		<div id="empty">
			<h3>Δεν υπάρχουν παραγγελίες αυτή την στιγμή.Μόλις υπάρξει κάποια θα ενημερωθήτε αμέσως!</h3>
		</div>
	</div> 


</div>
<div class="end"></div>
<script type="text/javascript" src="../js/manager_view2.js"></script>
</body>
</html>
