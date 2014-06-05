@extends('layouts.guest')

@section('content')
<div class="container" style="margin-top:30px" ng-controller="LoginController">
	<div class="col-md-4 col-md-offset-4">
	    <div class="panel panel-default">
		  <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3></div>
		  <div class="panel-body">
			<form role="form">
			<div class="form-group">
				<label for="email">Username or Email</label>
				<input type="email" ng-model="user.email" class="form-control" style="border-radius:0px" name="email" id="email" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="password">Password <a href="/sessions/forgot_password">(forgot password)</a></label>
				<input type="password" ng-model="user.password" class="form-control" style="border-radius:0px" name="password" id="password" placeholder="Password">
			</div>
			<a type="submit" ng-click="submitLogin()" href="#" class="btn btn-sm btn-primary">Sign in</a>
			</form>
		  </div>
		</div>
	</div>
</div>
@stop