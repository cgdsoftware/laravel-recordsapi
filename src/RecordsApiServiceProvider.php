<?php

namespace Iamdevmaniac\Recordsapi;

use Iamdevmaniac\Recordsapi\Http\AllServices;
use Iamdevmaniac\Recordsapi\Http\Services\AllServices as ServicesAllServices;
use Illuminate\Support\ServiceProvider;

class RecordsApiServiceProvider extends ServiceProvider
{

    public  function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->mergeConfigFrom(
            __DIR__.'/config/recordsapi.php', 'recordsapi'
        );

        $this->publishes([
            __DIR__.'/config/recordsapi.php' => config_path('recordsapi.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('recordsapi', function()
        {
            return new AllServices();

        });
    }
}
