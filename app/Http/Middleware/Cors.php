<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
            ->header('Sec-Fetch-Dest', 'empty')
            ->header('Sec-Fetch-Mode', 'cors')
            ->header('Sec-Fetch-Sit', 'cross-site')
            ->header('Accept-Encoding', 'gzip, deflate, br')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers',' Origin, X-Requested-With, Content-Type, Accept');
    }
}
