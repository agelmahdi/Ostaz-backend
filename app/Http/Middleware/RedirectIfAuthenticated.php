<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $Admin = Auth::guard($guard = "admin")->check();
        $Follower = Auth::guard($guard = "follower")->check();
        $Streamer = Auth::guard($guard = "streamer")->check();

        if ($Admin && !$Follower && !$Streamer) {
            if ($request->path() == "follower/login") {
                return $next($request);
            } elseif ($request->path() == "streamer/login") {
                return $next($request);
            } else
                return redirect('en/Admin/dashboard');
        } elseif (!$Admin && $Follower && !$Streamer) {
            if ($request->path() == "admin/login") {
                return $next($request);
            } elseif ($request->path() == "streamer/login") {
                return $next($request);
            } else
                return redirect('/follower/home');
        } elseif (!$Admin && !$Follower && $Streamer) {
            if ($request->path() == "admin/login") {
                return $next($request);
            } elseif ($request->path() == "follower/login") {
                return $next($request);
            } else
                return redirect('/streamer/home');
        } elseif ($Admin && $Follower && !$Streamer) {
            if ($request->path() == "admin/login") {
                return redirect('en/Admin/dashboard');
            } elseif ($request->path() == "follower/login") {
                return redirect('/follower/home');
            } else
                return $next($request);
        } elseif ($Admin && !$Follower && $Streamer) {
            if ($request->path() == "admin/login") {
                return redirect('en/Admin/dashboard');
            } elseif ($request->path() == "streamer/login") {
                return redirect('/streamer/home');
            } else
                return $next($request);
        } elseif (!$Admin && $Follower && $Streamer) {
            if ($request->path() == "follower/login") {
                return redirect('/follower/home');
            } elseif ($request->path() == "streamer/login") {
                return redirect('/streamer/home');
            } else
                return $next($request);
        } elseif ($Admin && $Follower && $Streamer) {
            if ($request->path() == "follower/login") {
                return redirect('/follower/home');
            } elseif ($request->path() == "streamer/login") {
                return redirect('/streamer/home');
            } else
                return redirect('en/Admin/dashboard');
        }

        return $next($request);
    }
}
