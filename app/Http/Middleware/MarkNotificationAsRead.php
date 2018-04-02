<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\Organiser;
use Closure;
use Illuminate\Support\Facades\Auth;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('read') && $request->has('organiser_id')) {
            $organiser = Organiser::scope()->findOrFail($request->organiser_id);
            $notification = $organiser->notifications()->where('id', $request->read)->first();
            if($notification) {
                $notification->markAsRead();
            }

        } else if($request->has('read') && $request->has('client_id')) {
            $client = Client::findOrFail($request->client_id);
            $notification = $client->notifications()->where('id', $request->read)->first();
            if($notification) {
                $notification->markAsRead();
            }
        }


        return $next($request);
    }
}
