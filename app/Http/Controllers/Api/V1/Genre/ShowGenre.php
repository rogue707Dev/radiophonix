<?php

namespace Radiophonix\Http\Controllers\Api\V1\Genre;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\GenreTransformer;
use Radiophonix\Models\Genre;

class ShowGenre extends ApiController
{
    /**
     * @param Genre $genre
     * @return ApiResponse
     */
    public function __invoke(Genre $genre)
    {
        // @todo gérer via un paramètre ?with=sagas
        $genre->load('sagas');

        return $this->item($genre, new GenreTransformer);
    }
}
