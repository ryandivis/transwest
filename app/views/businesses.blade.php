@extends('layouts.master')

@section('content')
<div ng-controller="BusinessesController">
	<div class="page-header clearfix">
		<div class="pull-left">
	  		<h1>Businesses</h1>
	 	</div>
	  	<div class="pull-right">
	  		<a ng-click="newBusiness()" class="btn btn-primary">New Business</a>
	  	</div>
	</div>
	<div class="table">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Actions</th>
				</tr>
			<thead>
			<tbody>
				<tr ng-repeat="business in businesses" ng-click="goToBusiness(business.id)">
					<td><< business.id >></td>
					<td><< business.name >></td>
					<td><< business.phone >></td>
					<td>
						<span ng-repeat="action in ticket.actions">
							<a ng-click="ticketAction(action,ticket);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop