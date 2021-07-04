<?php

namespace Messenger\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class WrapperServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/msg91.php' => config_path('msg91.php'),
        ], 'messenger-config');

	    $this->publishes([
		    __DIR__ . '/../Traits/SubscriptionNotifiable.php' => app_path('Traits/SubscriptionNotifiable.php'),
	    ], 'messenger-trait');

	    $this->publishes([
		    __DIR__ . '/../Template.php' => app_path('Lib/Template.php'),
	    ], 'messenger-template');

	    $this->publishes([
		    __DIR__ . '/../Jobs/NotifyViaSms.php' => app_path('Jobs/NotifyViaSms.php'),
	    ], 'messenger-jobs');

	    $this->publishes([
		    __DIR__ . '/../../config/msg91.php' => config_path('msg91.php'),
		    __DIR__ . '/../Template.php' => app_path('Lib/Template.php'),
//		    __DIR__ . '/../Traits/SubscriptionNotifiable.php' => app_path('Traits/SubscriptionNotifiable.php'),
//		    __DIR__ . '/../Jobs/NotifyViaSms.php' => app_path('Jobs/NotifyViaSms.php'),
	    ], 'messenger-all');
    }

    public function register(): void
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
