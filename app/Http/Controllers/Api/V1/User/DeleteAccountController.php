<?php

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\ValidationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Auth\DeleteAccountRequest;

class DeleteAccountController extends ApiController
{
    /** @var Hasher */
    private $hasher;

    /**
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function __invoke(DeleteAccountRequest $request): ApiResponse
    {
        if (!$this->hasher->check($request->get('password'), $this->user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['Mot de passe incorrect'],
            ]);
        }

        $this->user()->delete();

        return $this->ok();
    }
}
