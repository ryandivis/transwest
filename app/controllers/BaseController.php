<?php

class BaseController extends Controller {

	function __construct() {
		if(Auth::check()) {
			View::share('user',Auth::user());
			View::share('isSuperuser',Utils::isSuperuser());
			View::share('isManager',Utils::isManager());
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function error($msg) {
		return Response::json(array(
			'status' => 'error',
			'message' => $msg
		));
	}

}
