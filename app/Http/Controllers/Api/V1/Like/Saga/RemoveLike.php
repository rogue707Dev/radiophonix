<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like\Saga;

use Radiophonix\Events\Like\UserUnlikedSaga;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\LikesTransformer;
use Radiophonix\Models\Saga;
use Radiophonix\Repositories\LikeRepository;

class RemoveLike extends ApiController
{
    /** @var LikeRepository */
    private $repository;

    public function __construct(LikeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Saga $saga): ApiResponse
    {
        $like = $this->repository->forUserAndLikeable($this->user(), $saga);

        if ($like != null) {
            $like->delete();

            event(new UserUnlikedSaga($this->user(), $saga));
        }

        return $this->item(
            $this->repository->forUser($this->user()),
            new LikesTransformer
        );
    }
}
