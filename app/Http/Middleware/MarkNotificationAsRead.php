<?php

namespace App\Http\Middleware;

use App\Models\Organiser;
use Closure;

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
        if($request->has('read')) {
            $organiser = Organiser::scope()->findOrFail($request->organiser_id);
            $notification = $organiser->notifications()->where('id', $request->read)->first();
            if($notification) {
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
