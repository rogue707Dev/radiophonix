<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like\Saga;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\LikesTransformer;
use Radiophonix\Models\Like;
use Radiophonix\Models\Saga;
use Radiophonix\Repositories\LikeRepository;

class AddLike extends ApiController
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
            return $this->likes();
        }

        $like = new Like;

        $like->likeable()->associate($saga);
        $like->user()->associate($this->user());

        $like->save();

        return $this->likes();
    }

    private function likes(): ApiResponse
    {
        return $this->item(
            $this->repository->forUser($this->user()),
            new LikesTransformer
        );
    }
}
