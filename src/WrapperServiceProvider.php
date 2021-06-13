<?php

namespace Messenger;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class WrapperServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/msg91.php' => config_path('msg91.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('msg91', function ($app) {
            return new Wrapper();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    // public function provides()
    // {
    //     return array('msg91');
    // }

}
