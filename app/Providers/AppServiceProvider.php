<?php

namespace App\Providers;

use App\Models\Event;
use Debugbar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
//use LaravelPusher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //require app_path('Attendize/constants.php');

//        $pusher = $this->app->make('pusher');
//        $pusher->set_logger( new LaravelLoggerProxy() );

    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar', 'App\Services\Registrar'
        );
    }
}
//
//class LaravelLoggerProxy { // logging pusher events
//    public function log( $msg ) {
//        Log::info($msg);
//    }
//}
