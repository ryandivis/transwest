<!DOCTYPE html>
<html ng-app="transwestApp">
	<head>
		<title>{{ isset($pageTitle)? $pageTitle : 'Transwest Mobile Truck Repair' }}</title>
		{{ HTML::style('css/transwest.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.min.js') }}
		{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap.min.js') }}
		{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.js') }}
		{{ HTML::script('//code.jquery.com/jquery-1.10.1.min.js') }}
		{{ HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/transwest.js') }}
		<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation" ng-controller="MasterController">
			<div class="container">
				<div class="containter-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Transwest Mobile Truck Repair</a>
					</div>
				</div>
				<div class="collapse navbar-collapse">
	      			<ul class="nav navbar-nav navbar-right">
	      				<li><a href="/profile">Welcome {{ $user->firstname }}!</a></li>
	      				<li><a href="/">Dashboard</a></li>
	      				@if($isSuperuser)
	      					<li><a href="/businesses">Businesses</a></li>
	      				@else
	      					<li><a href="/my-business">My Business</a></li>
	      				@endif
	      				<li><a href="/calendar">Calendar</a></li>
	      				<li><a ng-click="logout();" href="#">Logout</a></li>
	      			</ul>
	      		</div>
      		</div>
		</nav>
		<div class="container">
	        @if(Session::has('message'))
	            <p class="alert">{{ Session::get('message') }}</p>
	        @endif
	    </div>
		<div class="container">
			<section class="content">
				@yield('content')
			</section>
		</div>
	</body>
</html>
