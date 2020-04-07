<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotFollower
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="follower")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('follower.login'));
        }

        return $next($request);
    }
}
