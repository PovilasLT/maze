<?php namespace maze\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use \Pusher;
use View;

class ConferServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('push', function($app) {
            $keys = $app['config']->get('services.pusher');
            return new Pusher($keys['public'], $keys['secret'], $keys['app_id']);
        });
        AliasLoader::getInstance()->alias('Push', 'maze\Facades\Push');
        View::composer('confer::confer', 'maze\Http\ViewComposers\ConferComposer');
        View::composer('confer::barconversationlist', 'maze\Http\ViewComposers\ConferBarComposer');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //if ($this->app->runningInConsole()) return false;

        $this->loadViewsFrom(__DIR__ . '/views', 'confer');
    }

}