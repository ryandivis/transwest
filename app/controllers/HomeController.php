<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin()
	{
		return View::make('login');
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(),array(
			"email" => "required",
			"password" => "required"
		));

		if($validator->passes()) {
			$credentials = array(
				"email" => Input::get("email"),
				"password" => Input::get("password")
			);
			if(Auth::attempt($credentials,true)) {
				return Response::json(array('status' => 'ok', 'message' => 'User validated'));
			} else {
				return Response::json(array('status' => 'error', 'message' => 'Email/Password is incorrect'));	
			}
		} else {
			return Response::json(array('status' => 'error', 'message' => $validator->errors()->all()));
		}
	}

	public function logout()
	{
		Auth::logout();
		return Response::json(array('status' => 'ok', 'message' => 'Successfully logged out'));
	}

	public function showRegistration()
	{
		return View::make('registration');
	}

	public function postRegistration()
	{
		$validator = Validator::make(Input::all(),User::$rules);

		if($validator->passes()) {
			//check and see if the accesscode is valid
			$validAccessCode = false;
			$accesscode = AccessCode::where('code','=',Input::get('accessCode'))->first();

			if($accesscode) {
				try{
					$user = new User();
					$user->firstname = Input::get('firstname');
					$user->lastname = Input::get('lastname');
					$user->email = Input::get('email');
					$user->password = Hash::make(Input::get('password'));
					$user->business_id = $accesscode->business_id;
					$user->supervisor_id = $accesscode->supervisor_id;
					$user->user_role_id = $accesscode->user_role_id;
					$user->save();

					$credentials = array(
						"email" => $user->email,
						"password" => Input::get('password')
					);

					Auth::attempt($credentials,true);

					return Response::json(array('status' => 'ok', 'message' => 'Successfully Registered!'));

				} catch(Exception $e) {
					return Response::json(array('status' => 'error', 'message' => $e->getMessage()));
				}
			} else {
				return Response::json(array('status' => 'error', 'message' => 'AccessCode invalid'));
			}
				
		} else {
			return Response::json(array('status' => 'error', 'message' => $validator->errors()->all()));
		}
	}

	public function remindPassword()
	{

	}

	public function dashboard()
	{
		return View::make('dashboard');
	}

}
