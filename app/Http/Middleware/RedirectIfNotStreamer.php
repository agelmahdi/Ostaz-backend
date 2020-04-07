<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotStreamer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="streamer")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('streamer.login'));
        }

        return $next($request);
    }
}
