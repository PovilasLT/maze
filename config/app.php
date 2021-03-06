<?php

return [
	
	//Maze config
	
	'version' => '2.1.0',

	'advertisements' => env('APP_SIDEBAR_ADVERTISEMENTS', 8),

	'front_page_nodes' => [
		'15',
		'18',
		'22',
		'26',
		'30',
		'34',
		'38',
		'42',
		'46',
		'48',
		'49',
		'50',
		'51',
		'52',
		'53',
		'54',
		'55',
		'56',
		'57',
		'67',
		'68',
		'69',
		'73',
		'74',
		'76',
		'77',
		'78',
		'79',
		'80',
		'63',
		'59',
		'81',
	],

	//Svorio paskirstymas

	'topics_decay'			=> 2,

	'reply_gain_weight' 	=> 6,

	'upvote_gain_weight'	=> 10,
	'downvote_lose_weight'	=> 8,

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => env('APP_DEBUG', true),

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://maze.lt',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'Europe/Vilnius',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'lt',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	|
	| The fallback locale determines the locale to use when the current one
	| is not available. You may change the value to correspond to any of
	| the language folders that are provided through your application.
	|
	*/

	'fallback_locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => env('APP_KEY', 'SomeRandomString'),

	'cipher' => MCRYPT_RIJNDAEL_128,

	/*
	|--------------------------------------------------------------------------
	| Logging Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may configure the log settings for your application. Out of
	| the box, Laravel uses the Monolog PHP logging library. This gives
	| you a variety of powerful log handlers / formatters to utilize.
	|
	| Available Settings: "single", "daily", "syslog", "errorlog"
	|
	*/

	'log' => 'daily',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => [

		/*
		 * Laravel Framework Service Providers...
		 */
		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Bus\BusServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Foundation\Providers\FoundationServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Pipeline\PipelineServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Broadcasting\BroadcastServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',

		/*
		 * Application Service Providers...
		 */
		'maze\Providers\AppServiceProvider',
		'maze\Providers\BusServiceProvider',
		'maze\Providers\ConfigServiceProvider',
		'maze\Providers\EventServiceProvider',
		'maze\Providers\RouteServiceProvider',

		/*
		 * Papildomi paketai
		 */

		'Laracasts\Flash\FlashServiceProvider',
		'Zizaco\Entrust\EntrustServiceProvider',
		'Intervention\Image\ImageServiceProvider',
		'DaveJamesMiller\Breadcrumbs\ServiceProvider',
		'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
		'DaveJamesMiller\Breadcrumbs\ServiceProvider',
		'Greggilbert\Recaptcha\RecaptchaServiceProvider',
		Barryvdh\Debugbar\ServiceProvider::class,
	],

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => [

		'App'       => 'Illuminate\Support\Facades\App',
		'Artisan'   => 'Illuminate\Support\Facades\Artisan',
		'Auth'      => 'Illuminate\Support\Facades\Auth',
		'Blade'     => 'Illuminate\Support\Facades\Blade',
		'Bus'       => 'Illuminate\Support\Facades\Bus',
		'Cache'     => 'Illuminate\Support\Facades\Cache',
		'Config'    => 'Illuminate\Support\Facades\Config',
		'Cookie'    => 'Illuminate\Support\Facades\Cookie',
		'Crypt'     => 'Illuminate\Support\Facades\Crypt',
		'DB'        => 'Illuminate\Support\Facades\DB',
		'Eloquent'  => 'Illuminate\Database\Eloquent\Model',
		'Event'     => 'Illuminate\Support\Facades\Event',
		'File'      => 'Illuminate\Support\Facades\File',
		'Hash'      => 'Illuminate\Support\Facades\Hash',
		'Input'     => 'Illuminate\Support\Facades\Input',
		'Inspiring' => 'Illuminate\Foundation\Inspiring',
		'Lang'      => 'Illuminate\Support\Facades\Lang',
		'Log'       => 'Illuminate\Support\Facades\Log',
		'Mail'      => 'Illuminate\Support\Facades\Mail',
		'Password'  => 'Illuminate\Support\Facades\Password',
		'Queue'     => 'Illuminate\Support\Facades\Queue',
		'Redirect'  => 'Illuminate\Support\Facades\Redirect',
		'Redis'     => 'Illuminate\Support\Facades\Redis',
		'Request'   => 'Illuminate\Support\Facades\Request',
		'Response'  => 'Illuminate\Support\Facades\Response',
		'Route'     => 'Illuminate\Support\Facades\Route',
		'Schema'    => 'Illuminate\Support\Facades\Schema',
		'Session'   => 'Illuminate\Support\Facades\Session',
		'Storage'   => 'Illuminate\Support\Facades\Storage',
		'URL'       => 'Illuminate\Support\Facades\URL',
		'Validator' => 'Illuminate\Support\Facades\Validator',
		'View'      => 'Illuminate\Support\Facades\View',

		//models
		'User'			=> 'maze\User',
		'Reply'			=> 'maze\Reply',
		'Topic'			=> 'maze\Topic',
		'Status'		=> 'maze\Status',		
		'StatusComment'	=> 'maze\StatusComment',
		'Mention'		=> 'maze\Mention',
		'Notification'	=> 'maze\Notification',
		'Vote'			=> 'maze\Vote',
		'Streamer' 		=> 'maze\Streamer',

		//3rd party
		'Flash' 		=> 'Laracasts\Flash\Flash',
		'Entrust' 		=> 'Zizaco\Entrust\EntrustFacade',
		'Image' 		=> 'Intervention\Image\Facades\Image',
		'Breadcrumbs' 	=> 'DaveJamesMiller\Breadcrumbs\Facade',
		'Form'          => 'Illuminate\Html\FormFacade', 
		'HTML'          => 'Illuminate\Html\HtmlFacade',
		'Recaptcha' 	=> 'Greggilbert\Recaptcha\Facades\Recaptcha',
		'Debugbar' => Barryvdh\Debugbar\Facade::class,

	],

];
