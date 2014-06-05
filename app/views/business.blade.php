@extends('layouts.master')

@section('content')
<div ng-init="business_id = '{{ $business->id }}'">
<div ng-controller="BusinessController">
	<div class="page-header">
  		<h1>{{ $business->name }}  <small>{{ $business->phone }}</small></h1>
	</div>
	@if($isManager)
	<div class="clearfix" style="margin-bottom:10px;">
		<a ng-click="newUser()" class="btn btn-primary pull-right" href="#">New User</a>
	</div>
	@endif
	<div class="table">
		<div class="top">
			<h3>Users</h3>
		</div>
		<table class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Role</th>
				<th>Vehicle ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Actions</th>
			</tr>
			<tr ng-repeat="user in users">
				<td><< user.id >></td>
				<td><< user.user_role.role >></td>
				<td><< user.vehicle.id >></td>
				<td><< user.firstname >></td>
				<td><< user.lastname >></td>
				<td><< user.email >></td>
				<td><< user.work_phone >></td>
				<td>
					<span ng-repeat="action in user.actions">
						<a ng-click="userAction(action,user);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
					</span>
				</td>
			</tr>
		</table>
	</div>
	@if($isManager)
	<div class="clearfix" style="margin-bottom:10px;">
		<a ng-click="newVehicle()" class="btn btn-primary pull-right" href="#">New Vehicle</a>
	</div>
	@endif
	<div class="table">
		<div class="top">
			<h3>Vehicles</h3>
		</div>
		<table class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Driver</th>
				<th>Fleet #</th>
				<th>Mileage</th>
				<th>Year</th>
				<th>Make</th>
				<th>Model</th>
				<th>VIN</th>
				<th>Actions</th>
			</tr>
			<tr ng-repeat="vehicle in vehicles" ng-click="viewVehicle(vehicle.id)">
				<td><< vehicle.id >></td>
				<td><< vehicle.driver.firstname + " " + vehicle.driver.lastname >></td>
				<td><< vehicle.fleet_id >></td>
				<td><< vehicle.mileage[0].mileage >></td>
				<td><< vehicle.year >></td>
				<td><< vehicle.make >></td>
				<td><< vehicle.model >></td>
				<td><< vehicle.vin >></td>
				<td>
					<span ng-repeat="action in vehicle.actions">
						<a ng-click="ticketAction(action,vehicle);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
					</span>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>
<script>
  // 	window.sdkAsyncInit = function() {
  //   	// Instantiate the SDK
		// var res = new EDMUNDSAPI('x6mevjmf4xykthnyanq964gf');
		// // Optional parameters
		// var options = {
		// 	// "manufacturerCode": "3548"
		// };
		// // Callback function to be called when the API response is returned
		// function success(res) {
		// 	console.log(res);
		// }
		// // Oops, Houston we have a problem!
		// function fail(data) {
		// 	console.log(data);
		// }
		// // Fire the API call
		// res.api('/api/vehicle/v2/vins/1N4AL3AP9DN441925', options, success, fail);
	 //    // Additional initialization code such as adding Event Listeners goes here
  // };
  // Load the SDK asynchronously
  (function(d, s, id){
     	var js, sdkjs = d.getElementsByTagName(s)[0];
     	if (d.getElementById(id)) {return;}
     	js = d.createElement(s); js.id = id;
     	js.src = "/js/edmunds.api.sdk.js";
     	sdkjs.parentNode.insertBefore(js, sdkjs);
   }(document, 'script', 'edmunds-jssdk'));
</script>
@stop