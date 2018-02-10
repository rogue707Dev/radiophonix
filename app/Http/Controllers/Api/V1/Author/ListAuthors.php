<?php

namespace Radiophonix\Http\Controllers\Api\V1\Author;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\AuthorTransformer;
use Radiophonix\Models\Author;

class ListAuthors extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->collection(Author::all(), new AuthorTransformer);
    }
}
