<?php

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Auth\RegisterUserRequest;
use Radiophonix\Http\Transformers\UserTransformer;
use Radiophonix\Models\User;

class RegisterUser extends ApiController
{
    public function __invoke(RegisterUserRequest $request): ApiResponse
    {
        $user = User::create([
            'email' => $request->get('email'),
            'name' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);

        return $this->item($user, new UserTransformer());
    }
}
