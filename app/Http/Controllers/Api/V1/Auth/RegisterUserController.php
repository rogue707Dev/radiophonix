<?php

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Illuminate\Validation\ValidationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Auth\RegisterUserRequest;
use Radiophonix\Http\Transformers\UserTransformer;
use Radiophonix\Models\SiteInvite;
use Radiophonix\Models\User;

class RegisterUserController extends ApiController
{
    public function __invoke(RegisterUserRequest $request): ApiResponse
    {
        if ($request->hasInvite()) {
            // @todo chercher l'invitaiton via l'email au cas où le user n'ai pas utilisé le lien avec le code

            /** @var SiteInvite $invite */
            $invite = SiteInvite::query()
                ->where('uuid', $request->get('invite'))
                ->first();

            if (null === $invite) {
                throw ValidationException::withMessages([
                    'invite' => ['Ce code d\'invitation n\'existe pas']
                ]);
            }

            if ($invite->email !== $request->get('email')) {
                throw ValidationException::withMessages([
                    'invite' => ['L\'email fourni ne correspond pas à cette invitation']
                ]);
            }

            $invite->markAsUsed();
        }

        $user = User::query()->create([
            'email' => $request->get('email'),
            'name' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);

        // @todo émettre event avec $user et $invite

        return $this->item($user, new UserTransformer());
    }
}
