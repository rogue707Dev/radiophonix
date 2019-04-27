<?php

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\Profile\ProfileTransformer;
use Radiophonix\Models\User;

class ShowProfileController extends ApiController
{
    public function __invoke(User $user)
    {
        return $this->item($user, new ProfileTransformer());
    }
}