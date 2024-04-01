<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CORSMiddleware
 * @package App\Middleware
 */
class CORSMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    final public function handle($request, Closure $next)
    {
        // TODO change to your origin domain
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
