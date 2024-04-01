<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class AcceptMiddleware
 * @package App\Middleware
 */
class AcceptMiddleware
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
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
