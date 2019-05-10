<?php

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Illuminate\Validation\ValidationException;
use Radiophonix\Domain\Dto\LoginDto;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Auth\RegisterUserRequest;
use Radiophonix\Http\Transformers\LoginTransformer;
use Radiophonix\Models\SiteInvite;
use Radiophonix\Models\User;
use Radiophonix\Repositories\LikeRepository;

class RegisterUserController extends ApiController
{
    /** @var LikeRepository */
    private $repository;

    public function __construct(LikeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RegisterUserRequest $request): ApiResponse
    {
        if ($request->hasInvite()) {
            /** @var SiteInvite|null $invite */
            $invite = SiteInvite::query()
                ->where('uuid', $request->get('invite'))
                ->orWhere('email', $request->get('email'))
                ->first();

            if (null === $invite) {
                throw ValidationException::withMessages([
                    'invite' => ['Ce code d\'invitation n\'existe pas']
                ]);
            }

            $invite->markAsUsed();
        }

        /** @var User $user */
        $user = User::query()->create([
            'email' => $request->get('email'),
            'name' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);

        // @todo émettre event avec $user et $invite

        $token = auth()->login($user);

        return $this->item(
            new LoginDto(
                $token,
                $this->auth()->factory()->getTTL(),
                $user,
                $this->repository->forUser($user)
            ),
            new LoginTransformer()
        );
    }
}
