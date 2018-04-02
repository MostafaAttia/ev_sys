<?php

namespace App\Providers;

use App\Models\Organiser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.Models.Client.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });

        Broadcast::channel('App.Models.Organiser.*', function ($user, $userId) {
            return (int) $user->id === (int) Organiser::find($userId)->account_id;
        });

    }
}
