<?php namespace maze\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

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
        'maze\Http\Middleware\VerifyCsrfToken',
        'maze\Http\Middleware\CheckIfUserIsBanned',
        'maze\Http\Middleware\CheckIfUsernameValid',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \maze\Http\Middleware\Authenticate::class,
        'auth.basic' => Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \maze\Http\Middleware\RedirectIfAuthenticated::class,
        'CanManageTopics' => \maze\Http\Middleware\CanManageTopics::class,
        'CanManagePosts' => \maze\Http\Middleware\CanManagePosts::class,
        'CanManageUsers' => \maze\Http\Middleware\CanManageUsers::class,
        'CanManageStatuses' => \maze\Http\Middleware\CanManageStatuses::class,
        'CanManageComments' => \maze\Http\Middleware\CanManageComments::class,
        'IsAdmin' => \maze\Http\Middleware\IsAdmin::class,
        'IsMod' => \maze\Http\Middleware\IsMod::class,
        'IsPremium' => \maze\Http\Middleware\IsPremium::class,
        'loggedIn' => \maze\Http\Middleware\LogIn::class,
        'UserCanVote' => \maze\Http\Middleware\UserCanVote::class,
        'ThrottleReply' => \maze\Http\Middleware\ThrottleReply::class,
    ];
}
