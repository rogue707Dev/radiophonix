<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\LikesTransformer;
use Radiophonix\Repositories\LikeRepository;

class ListUserLikesController extends ApiController
{
    /** @var LikeRepository */
    private $repository;

    public function __construct(LikeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ApiResponse
    {
        return $this->item(
            $this->repository->forUser($this->user()),
            new LikesTransformer
        );
    }
}
