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
        $router->bind('user-slug', 'maze\User', function ($value) {
            $user = maze\User::where('slug', $value)->first();
            if ($user) {
                return $user;
            }
            abort(404);
        });
        $router->bind('topic-slug', function ($value) {
            $topic = maze\Topic::where('slug', $value)->first();
            if ($topic) {
                return $topic;
            }
            abort(404);
        });
        $router->bind('node-slug', function ($value) {
            $node = maze\Node::where('slug', $value)->first();
            if ($node) {
                return $node;
            }
            abort(404);
        });

        /**
         * ID Bindings
         */
        $router->model('node-id', 'maze\Node');
        $router->model('user-id', 'maze\User');
        $router->model('topic-id', 'maze\Topic');
        $router->model('reply-id', 'maze\Reply');
        $router->model('status-id', 'maze\Status');
        $router->model('statuscomment-id', 'maze\StatusComment');
        $router->model('notification-id', 'maze\Notification');
        $router->model('conversation-id', 'maze\Messenger\Conversation');
        $router->model('message-id', 'maze\Messenger\Message');
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
