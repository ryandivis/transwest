@extends('layouts.master')

@section('content')
<div ng-controller="DashboardController">
	<div class="clearfix" style="margin-bottom:10px;">
		<a ng-click="newTicket()" class="btn btn-primary pull-right" href="#">New Ticket</a>
	</div>
	<div class="table">
		<div class="top">
			<h3>Open Tickets</h3>
		</div>
		<table ng-show="tickets.open" class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Scheduled</th>
				<th>Company</th>
				<th>User</th>
				<th>Issue</th>
				<th>Notes</th>
				<th>Updated</th>
				<th>Actions</th>
			</tr>
			<tr ng-repeat="ticket in tickets.open">
				<td><< ticket.id >></td>
				<td>
					<span ng-if="ticket.scheduled">Yes</span>
					<span ng-if="!ticket.scheduled">No</span>
				</td>
				<td><< ticket.business.name >></td>
				<td><< ticket.user.email >></td>
				<td><< ticket.issue >></td>
				<td><< ticket.notes >></td>
				<td><< ticket.updated_at >></td>
				<td>
					<span ng-repeat="action in ticket.actions">
						<a ng-click="ticketAction(action,ticket);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
					</span>
				</td>
			</tr>
		</table>
		<div ng-hide="tickets.open">
			<p>There are currently no open tickets</p>
		</div>
	</div>
	<div class="table">
		<div class="top">
			<h3>Pending Tickets</h3>
		</div>
		<table ng-show="tickets.pending" class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Approved</th>
				<th>Company</th>
				<th>User</th>
				<th>Issue</th>
				<th>Notes</th>
				<th>Updated</th>
				<th>Actions</th>
			</tr>
			<tr ng-repeat="ticket in tickets.pending">
				<td><< ticket.id >></td>
				<td>
					<span ng-if="ticket.approved">Yes</span>
					<span ng-if="!ticket.approved">No</span>
				</td>
				<td><< ticket.business.name >></td>
				<td><< ticket.user.email >></td>
				<td><< ticket.issue >></td>
				<td><< ticket.notes >></td>
				<td><< ticket.updated_at >></td>
				<td>
					<span ng-repeat="action in ticket.actions">
						<a ng-click="ticketAction(action,ticket);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
					</span>
				</td>
			</tr>
		</table>
		<div ng-hide="tickets.pending">
			<p>There are currently no pending tickets</p>
		</div>
	</div>
	<div class="table">
		<div class="top">
			<h3>Closed Tickets</h3>
		</div>
		<table ng-show="tickets.closed" class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Status</th>
				<th>Company</th>
				<th>User</th>
				<th>Issue</th>
				<th>Notes</th>
				<th>Updated</th>
				<th>Actions</th>
			</tr>
			<tr ng-repeat="ticket in tickets.closed">
				<td><< ticket.id >></td>
				<td>
					<span ng-if="ticket.closed">Rejected</span>
					<span ng-if="ticket.resolved">Resolved</span>
				</td>
				<td><< ticket.business.name >></td>
				<td><< ticket.user.email >></td>
				<td><< ticket.issue >></td>
				<td><< ticket.notes >></td>
				<td><< ticket.updated_at >></td>
				<td>
					<span ng-repeat="action in ticket.actions">
						<a ng-click="ticketAction(action,ticket);" href="#"><< action.name >><span class="glyphicon <<action.name>>"></span></a><br/>
					</span>
				</td>
			</tr>
		</table>
		<div ng-hide="tickets.closed">
			<p>There are currently no closed tickets</p>
		</div>
	</div>
</div>
@stop