<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\Profile\ProfileLikesTransformer;
use Radiophonix\Models\User;
use Radiophonix\Repositories\LikeRepository;

class ShowProfileLikesController extends ApiController
{
    /** @var LikeRepository */
    private $repository;

    public function __construct(LikeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(User $user): ApiResponse
    {
        return $this->item(
            $this->repository->forUser($user),
            new ProfileLikesTransformer()
        );
    }
}
