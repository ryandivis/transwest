@extends('layouts.master')

@section('content')
<div class="container" style="margin-top:30px" ng-controller="RegistrationController">
	<div class="col-md-4 col-md-offset-4">
	    <div class="panel panel-default">
		  <div class="panel-heading"><h3 class="panel-title"><strong>Create Ticket</strong></h3></div>
		  <div class="panel-body">
			<form role="form">
			<div class="form-group">
				<label for="accessCode">Issue</label>
				<textarea ng-model="ticket.issue" name="issue" class="form-control"></textarea>
			</div>
			<div class="pull-right">
				<a href="#" ng-click="submitRegistration()" class="btn btn-sm btn-primary">Submit</a>
				<a href="#" ng-click="cancel()" class="btn btn-sm btn-default">Cancel</a>
			</div>
			</form>
		  </div>
		</div>
	</div>
</div>
@stop