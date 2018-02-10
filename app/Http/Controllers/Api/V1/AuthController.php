<?php

namespace Radiophonix\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Radiophonix\Http\Guard\JwtGuard;
use Radiophonix\Http\Requests\RegisterRequest;
use Radiophonix\Models\User;
use Radiophonix\Models\Author;
use Tymon\JWTAuth\Exceptions\JWTException;
use Radiophonix\Notifications\UserRegistered;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        // @todo

        $user = User::create([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        $author = new Author;

        $author->save();

        $author->owner()->associate($user);

        $user->notify(new UserRegistered);

        return $this->ok();
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (false === $token) {
            throw new UnauthorizedHttpException('Token', 'Invalid credentials');
        }

        return $this->simple(compact('token'));
    }

    public function logout(Request $request)
    {
        if ($request->has('token')) {
            /** @var JwtGuard $guard */
            $guard = Auth::guard('api');

            $guard->invalidate($request->get('token'));
        }

        return $this->ok();
    }

    public function refresh()
    {
        // @todo

        $token = \JWTAuth::getToken();

        if (!$token) {
            throw new JWTException;
        }

        $refreshedToken = \JWTAuth::refresh($token);

        return $this->simple([
            'token' => $refreshedToken
        ]);
    }
}
