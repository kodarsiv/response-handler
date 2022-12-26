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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind("Responser", function (){
            return new ResponseHandler();
        });
    }
}
