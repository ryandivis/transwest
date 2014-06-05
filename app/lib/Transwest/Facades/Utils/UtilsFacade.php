<?php

namespace Transwest\Facades\Utils;

use Illuminate\Support\Facades\Facade;

class UtilsFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		
		return 'utils';
		
	}

}