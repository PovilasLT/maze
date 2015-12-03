<?php namespace maze\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		/**
		 * <code>
		 * {? $old_section = "whatever" ?}
		 * </code>
		 */
		Blade::extend(function($value) {
		    return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
