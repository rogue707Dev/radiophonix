<?php

namespace Radiophonix\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Track;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class SagaVisibilityMiddleware
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
     * Check if a saga is visible by the current user or guest
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
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
            // We only check if the saga is private
            if ($saga->isPrivate()) {
                if (!Auth::check() || !$saga->isOwnedBy(Auth::user())) {
                    throw new ModelNotFoundException;
                }
            }
        }

        return $next($request);
    }
}
