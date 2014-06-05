<?php

namespace Transwest\Facades\Utils;

use Illuminate\Support\ServiceProvider;

class UtilsProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {

		$this->app['utils'] = $this->app->share(function($app) {
			return new Utils();
		});
		
	}

}