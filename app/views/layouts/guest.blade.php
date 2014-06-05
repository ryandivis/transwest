<!DOCTYPE html>
<html ng-app="transwestApp">
	<head>
		<title>{{ isset($pageTitle)? $pageTitle : 'Transwest Mobile Truck Repair' }}</title>
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
		<nav class="navbar navbar-default" role="navigation">
			<div class="inner">
				<div class="containter-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Transwest Mobile Truck Repair</a>
					</div>
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
		<div>
	</body>
</html>
