<?php namespace maze\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'maze\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
        
        /**
         * Misc. Bindings.
         */
        $router->bind('user', 'maze\User', function ($value) {
            return \maze\User::where('slug', $value)->firstOrFail();
        });
        $router->bind('topic', function ($value) {
            return \maze\Topic::where('slug', $value)->firstOrFail();
        });
        $router->bind('node', function ($value) {
            return \maze\Node::where('slug', $value)->firstOrFail();
        });
        $router->bind('streamer', function ($value) {
            return \maze\Streamer::where('twitch', $value)->firstOrFail();
        });
        $router->bind('channel', function($value) {
            return \maze\Channel::where('secret', $value)->firstOrFail();
        });
        /**
         * ID Bindings
         */
        $router->model('channel_id', 'maze\Channel');
        $router->model('reply', 'maze\Reply');
        $router->model('status', 'maze\Status');
        $router->model('streamer', 'maze\Streamer');
        $router->model('statuscomment', 'maze\StatusComment');
        $router->model('notification', 'maze\Notification');
        $router->model('conversation', 'maze\Messenger\Conversation');
        $router->model('message', 'maze\Messenger\Message');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
