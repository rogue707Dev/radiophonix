<?php

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Radiophonix\Dto\LoginDto;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Auth\LoginUserRequest;
use Radiophonix\Http\Transformers\LoginTransformer;
use Radiophonix\Models\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginUser extends ApiController
{
    public function __invoke(LoginUserRequest $request): ApiResponse
    {
        $credentials = $request->only(['email', 'password']);

        $token = auth()->attempt($credentials);

        if (false === $token) {
            throw new UnauthorizedHttpException('Token', 'Identifiants invalides');
        }

        return $this->item(
            new LoginDto(
                $token,
                auth()->factory()->getTTL(),
                $this->user()
            ),
            new LoginTransformer()
        );
    }
}
