@extends('layouts.guest')

@section('content')
<div class="container" style="margin-top:30px" ng-controller="RegistrationController">
	<div class="col-md-4 col-md-offset-4">
	    <div class="panel panel-default">
		  <div class="panel-heading"><h3 class="panel-title"><strong>Account Creation</strong></h3></div>
		  <div class="panel-body">
			<form role="form">
			<div class="form-group">
				<label for="accessCode">Access Code</label>
				<input ng-model="user.accessCode" class="form-control" style="border-radius:0px" name="accessCode" id="accessCode" placeholder="Access Code">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input ng-model="user.email" type="email" class="form-control" style="border-radius:0px" name="email" id="email" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="firstname">First Name</label>
				<input ng-model="user.firstname" class="form-control" style="border-radius:0px" name="firstname" id="firstname" placeholder="First Name">
			</div>
			<div class="form-group">
				<label for="lastname">Last Name</label>
				<input ng-model="user.lastname" class="form-control" style="border-radius:0px" name="lastname" id="lastname" placeholder="Last Name">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input ng-model="user.password" type="password" class="form-control" style="border-radius:0px" name="password" id="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label for="password_confirmation">Password Again</label>
				<input ng-model="user.password_confirmation" type="password" class="form-control" style="border-radius:0px" name="password_confirmation" id="password_confirmation" placeholder="Password Again">
			</div>
			<a href="#" ng-click="submitRegistration()" class="btn btn-sm btn-primary">Sign Up</a>
			</form>
		  </div>
		</div>
	</div>
</div>
@stop