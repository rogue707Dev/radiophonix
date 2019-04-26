<?php

namespace Radiophonix\Http\Controllers\Api\V1\Genre;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\GenreTransformer;
use Radiophonix\Models\Genre;

class ListGenresController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->collection(Genre::all(), new GenreTransformer);
    }
}
