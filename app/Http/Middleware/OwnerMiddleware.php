<?php

namespace Radiophonix\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Track;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tymon\JWTAuth\JWTAuth;

class OwnerMiddleware
{
    /**
     * @var JWTAuth
     */
    protected $jwt;

    /**
     * OwnerMiddleware constructor.
     * @param JWTAuth $jwt
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Check if the current user owns the desired saga/collection/track
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment() == 'testing') {
            $this->jwt->setRequest($request);
        }

        /** @var Saga $saga */
        $saga = null;

        // We get the saga from the route parameter
        if ($request->route('saga') instanceof Saga) {
            $saga = $request->route('saga');
        }

        if ($request->route('collection') instanceof Collection) {
            $saga = $request->route('collection')->saga;
        }

        if ($request->route('track') instanceof Track) {
            $saga = $request->route('track')->collection->saga;
        }

        if ($saga instanceof Saga) {
            $currentUser = Auth::guard('api')->user();

            if ($currentUser) {
                if (!$saga->isOwnedBy($currentUser)) {
                    if ($saga->isPublic()) {
                        throw new AccessDeniedHttpException();
                    }

                    throw new ModelNotFoundException();
                }
            }
        }

        return $next($request);
    }
}
