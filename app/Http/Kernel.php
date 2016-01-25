<?php namespace maze\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		//'maze\Http\Middleware\VerifyCsrfToken',
		'maze\Http\Middleware\CheckIfUserIsBanned',
		'maze\Http\Middleware\CheckIfUsernameValid',
		\LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'maze\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'maze\Http\Middleware\RedirectIfAuthenticated',
		'loggedIn' => \maze\Http\Middleware\LogIn::class,
		'UserCanVote' => \maze\Http\Middleware\UserCanVote::class,
		'ThrottleReply' => \maze\Http\Middleware\ThrottleReply::class,
		

		'oauth' => \LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class,
		'oauth-user' => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
		'oauth-client' => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
		'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,

		'csrf' => \maze\Http\Middleware\VerifyCsrfToken::class,
	];

}
