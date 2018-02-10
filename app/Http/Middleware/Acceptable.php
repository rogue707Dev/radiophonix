<?php

namespace Radiophonix\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class Acceptable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type = null)
    {
        if (!$request->accepts($type ?: 'application/json')) {
            throw new NotAcceptableHttpException();
        }

        return $next($request);
    }
}
