<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class CheckSuperAdmin
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

        $role_slug = Sentinel::check()->getRoles()[0]['slug'];

        if ($role_slug !== 'super_admin')
        {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
