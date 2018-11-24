<?php

namespace App\Http\Middleware;

use App\Services\Auth\ApiAuth;
use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if( ($token = $request->header('Auth-Token')) != null ) {
            $apiAuth = resolve(ApiAuth::class);
            $user = $apiAuth->user($token);
        } else {
            throw new HttpException(401, "Unauthorized.");
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
