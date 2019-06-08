<?php

namespace Radiophonix\Http\Controllers\Api\V1\Interaction\Like;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Requests\Interaction\Like\AddOrRemoveLikeRequest;
use Radiophonix\Models\Like;

class AddController extends LikeController
{
    public function __invoke(AddOrRemoveLikeRequest $request): ApiResponse
    {
        $likeable = $this->getLikeable($request);

        $like = $this->repository->forUserAndLikeable($this->user(), $likeable);

        if (null !== $like) {
            return $this->likes();
        }

        Like::createFor($this->user(), $likeable);

        return $this->likes();
    }
}
