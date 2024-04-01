<?php

namespace App\Middleware;

use App\Exceptions\VerificationException;
use Illuminate\Http\Request;
use Closure;

/**
 * Class VerifiedMiddleware
 * @package App\Middleware
 */
class VerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     * @throws VerificationException
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (is_null(auth()->user()->email_verified_at)) {
            throw new VerificationException();
        }

        return $next($request);
    }
}
