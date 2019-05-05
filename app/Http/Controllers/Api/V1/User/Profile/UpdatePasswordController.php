<?php

namespace Radiophonix\Http\Controllers\Api\V1\User\Profile;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class UpdatePasswordController extends ApiController
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8|max:255',
        ]);

        $isOldPasswordValid = auth()->validate([
            'email' => $this->user()->email,
            'password' => $request->get('old_password'),
        ]);

        if (!$isOldPasswordValid) {
            throw ValidationException::withMessages([
                'old_password' => ['Mot de passe incorrect'],
            ]);
        }

        $this->user()->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return $this->ok();
    }
}
