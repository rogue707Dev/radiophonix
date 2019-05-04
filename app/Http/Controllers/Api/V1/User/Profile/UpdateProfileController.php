<?php

namespace Radiophonix\Http\Controllers\Api\V1\User\Profile;

use Illuminate\Http\Request;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\UserTransformer;

class UpdateProfileController extends ApiController
{
    public function __invoke(Request $request): ApiResponse
    {
        $this->validate($request, [
            'name' => 'required|alpha_dash|min:2|max:40|unique:users,name,' . $this->user()->id,
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
        ]);

        $user = $this->user();
        $user->update($request->only('name', 'email'));

        return $this->item($user, new UserTransformer());
    }
}
