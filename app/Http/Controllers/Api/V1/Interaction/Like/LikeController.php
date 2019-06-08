<?php

namespace Radiophonix\Http\Controllers\Api\V1\Interaction\Like;

use Illuminate\Database\Eloquent\Model;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Interaction\Like\AddOrRemoveLikeRequest;
use Radiophonix\Http\Transformers\LikesTransformer;
use Radiophonix\Models\Saga;
use Radiophonix\Repositories\LikeRepository;

abstract class LikeController extends ApiController
{
    /** @var LikeRepository */
    protected $repository;

    public function __construct(LikeRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getLikeable(AddOrRemoveLikeRequest $request): ?Model
    {
        $model = null;

        switch ($request->get('type')) {
            case 'saga':
                $model = Saga::findFromSlugOrUuid($request->get('id'));
        }

        if (null === $model) {
            abort(404);
        }

        return $model;
    }

    protected function likes(): ApiResponse
    {
        return $this->item(
            $this->repository->forUser($this->user()),
            new LikesTransformer
        );
    }
}
