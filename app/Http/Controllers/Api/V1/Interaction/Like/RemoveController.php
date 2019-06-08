<?php

namespace Radiophonix\Http\Controllers\Api\V1\Interaction\Like;

use Radiophonix\Events\Like\UserUnlikedSaga;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Requests\Interaction\Like\AddOrRemoveLikeRequest;
use Radiophonix\Http\Transformers\LikesTransformer;
use Radiophonix\Models\Saga;

class RemoveController extends LikeController
{
    public function __invoke(AddOrRemoveLikeRequest $request): ApiResponse
    {
        $likeable = $this->getLikeable($request);

        $like = $this->repository->forUserAndLikeable($this->user(), $likeable);

        if ($like != null) {
            $like->delete();

            if ($likeable instanceof Saga) {
                event(new UserUnlikedSaga($this->user(), $likeable));
            }
        }

        return $this->likes();
    }
}
