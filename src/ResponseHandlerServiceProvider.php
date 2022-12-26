<?php


namespace Tanerincode\ResponseHandler;

use Illuminate\Support\ServiceProvider;


class ResponseHandlerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__."/config.php", "rh");

        // if you need to publish here is
        $this->publishes([
            __DIR__ . '/config.php' => config_path('rh_config.php'),
        ], 'rh.config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind("Responder", function (){
            return new ResponseHandler();
        });
    }
}
