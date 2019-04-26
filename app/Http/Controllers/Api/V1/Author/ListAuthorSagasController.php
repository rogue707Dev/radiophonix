<?php

namespace Radiophonix\Http\Controllers\Api\V1\Author;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Author;

class ListAuthorSagasController extends ApiController
{
    /**
     * @param Author $author
     * @return ApiResponse
     */
    public function __invoke(Author $author)
    {
        return $this->collection($author->sagas, new SagaTransformer);
    }
}
