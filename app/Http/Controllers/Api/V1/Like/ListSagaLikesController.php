<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Radiophonix\Domain\Dto\SagaLikesDto;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\Like\SagaLikesTransformer;
use Radiophonix\Models\Saga;

class ListSagaLikesController extends ApiController
{
    public function __invoke(Saga $saga): ApiResponse
    {
        $total = $saga->likes()->count();

        $names = $saga->likes()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->pluck('user.name')
            ->all();

        return $this->item(new SagaLikesDto($names, $total), new SagaLikesTransformer());
    }
}
