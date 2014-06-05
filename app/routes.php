<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', array(
	'as' => 'login',
	'uses' => 'HomeController@showLogin'
));

Route::post('/login',array(
	'as' => 'postLogin',
	'uses' => 'HomeController@postLogin'
));

Route::get('/register',array(
	'as' => 'register',
	'uses' => 'HomeController@showRegistration'
));

Route::post('/register',array(
	'as' => 'postRegister',
	'uses' => 'HomeController@postRegistration'
));

Route::group(array('before' => 'auth'), function()
{
	Route::get('/',array(
		'as' => 'dashboard',
		'uses' => 'HomeController@dashboard'
	));

	Route::any('/logout',array(
		'as' => 'logout',
		'uses' => 'HomeController@logout'
	));

	Route::get('/tickets',array(
		'as' => 'tickets',
		'uses' => 'TicketsController@getTickets'
	));

	Route::post('/tickets',array(
		'as' => 'createTicket',
		'uses' => 'TicketsController@createTicket'
	));

	Route::get('/tickets/{id}',array(
		'as' => 'getTicket',
		'uses' => 'TicketsController@getTicket'
	));

	Route::put('/tickets/{id}',array(
		'as' => 'editTicket',
		'uses' => 'TicketsController@editTicket'
	));

	Route::post('/tickets/{id}/comment',array(
		'as' => 'createTicketComment',
		'uses' => 'TicketsController@addTicketComment'
	));

	Route::put('/tickets/{id}/approve',array(
		'as' => 'approveTicket',
		'uses' => 'TicketsController@approveTicket'
	));

	Route::delete('/tickets/{id}',array(
		'as' => 'deleteTicket',
		'uses' => 'TicketsController@deleteTicket'
	));

	Route::put('/tickets/{id}/resolve',array(
		'as' => 'resolveTicket',
		'uses' => 'TicketsController@resolveTicket'
	));

	Route::put('/tickets/{id}/reopen',array(
		'as' => 'reopenTicket',
		'uses' => 'TicketsController@reopenTicket'
	));

	Route::get('/tickets/new',array(
		'as' => 'newTickets',
		'uses' => 'TicketsController@newTicket'
	));

	Route::get('/tickets/open',array(
		'as' => 'openTickets',
		'uses' => 'TicketsController@getOpenTickets'
	));

	Route::get('/tickets/pending',array(
		'as' => 'pendingTickets',
		'uses' => 'TicketsController@getPendingTickets'
	));

	Route::get('/tickets/closed',array(
		'as' => 'closedTickets',
		'uses' => 'TicketsController@getClosedTickets'
	));

	Route::get('/calendar',array(
		'as' => 'calendar',
		'uses' => 'CalendarController@calendar'
	));

	//users
	Route::get('/users',array(
		'as' => 'getUsers',
		'uses' => 'UsersController@getUsers'
	));

	Route::post('/users',array(
		'as' => 'createUsers',
		'uses' => 'UsersController@createUser'
	));

	Route::put('/api/users/{id}',array(
		'as' => 'editUser',
		'uses' => 'UsersController@editUser'
	));

	Route::delete('/api/users/{id}',array(
		'as' => 'deleteUser',
		'uses' => 'UsersController@deleteUser'
	));

	Route::get('/users/{id}',array(
		'as' => 'getUser',
		'uses' => 'UsersController@getUser'
	))->where('id', '[0-9]+');

	Route::get('/api/user-roles',array(
		'as' => 'userRoles',
		'uses' => 'UsersController@userRoles'
	));

	//businesses
	Route::get('/businesses',array(
		'as' => 'businesses',
		'uses' => 'BusinessesController@businesses'
	));

	Route::get('/business/{id}',array(
		'as' => 'business',
		'uses' => 'BusinessesController@business'
	));

	Route::get('/my-business',array(
		'as' => 'myBusiness',
		'uses' => 'BusinessesController@myBusiness'
	));

	Route::get('/api/business/{id}/users',array(
		'as' => 'businessUsers',
		'uses' => 'BusinessesController@businessUsers'
	));

	Route::get('/api/business/{id}/users/{type?}',array(
		'as' => 'businessUsersType',
		'uses' => 'BusinessesController@businessUsers'
	));

	Route::get('/api/business/{id}/vehicles',array(
		'as' => 'businessVehicles',
		'uses' => 'BusinessesController@businessVehicles'
	));

	Route::get('/api/businesses',array(
		'as' => 'apiBusinesses',
		'uses' => 'BusinessesController@getBusinesses'
	));

	Route::get('/api/business/{id}',array(
		'as' => 'apiBusiness',
		'uses' => 'BusinessesController@getBusiness'
	));

	Route::post('/api/business',array(
		'as' => 'apiCreateBusiness',
		'uses' => 'BusinessesController@createBusiness'
	));


	//vehicles
	Route::post('/vehicles',array(
		'as' => 'apiCreateVehicle',
		'uses' => 'VehiclesController@createVehicle'
	));

	Route::get('/api/vehicles/{id}',array(
		'as' => 'apiGetVehicle',
		'uses' => 'VehiclesController@getVehicle'
	));

	Route::put('/api/vehicles/{id}',array(
		'as' => 'apiUpdateVehicle',
		'uses' => 'VehiclesController@updateVehicle'
	));

	Route::delete('/api/vehicles/{id}',array(
		'as' => 'apiDeleteVehicle',
		'uses' => 'VehiclesController@deleteVehicle'
	));

	//mileage
	Route::post('/mileage',array(
		'as' => 'apiCreateMileage',
		'uses' => 'MileageController@createMileage'
	));

});
