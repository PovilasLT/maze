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
        
        $router->bind('user', 'maze\User', function ($value) {
            $user = maze\User::where('slug', $value)->first();
            if ($user) {
                return $user;
            }
            abort(404);
        });
        $router->bind('topic', function ($value) {
            $topic = maze\Topic::where('slug', $value)->first();
            if ($topic) {
                return $topic;
            }
            abort(404);
        });
        $router->bind('node', function ($value) {
            $node = maze\Node::where('slug', $value)->first();
            if ($node) {
                return $node;
            }
            abort(404);
        });
        $router->model('reply', 'maze\Reply');
        $router->model('status', 'maze\Status');
        $router->model('status_comment', 'maze\StatusComment');
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
