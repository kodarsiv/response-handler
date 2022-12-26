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
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Responser", function (){
            return new ResponseHandler();
        });
    }
}
