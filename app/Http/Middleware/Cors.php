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
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Max-Age', 24 * 60 * 60); // 24 hrs
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
        $response->headers->set(
            'Access-Control-Allow-Headers',
            'Content-Type, Accept, Authorization, X-Requested-With, Application'
        );
        $response->headers->set(
            'Access-Control-Expose-Headers',
            'Content-Type, Accept, Authorization, X-Requested-With, Application, Content-Disposition'
        );
        return $response;
    }
}
