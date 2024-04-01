<?php

namespace App\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

/**
 * Class AuthMiddleware
 * @package App\Middleware
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guest()) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
