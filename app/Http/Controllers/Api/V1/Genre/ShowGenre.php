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
        $genre->load('sagas.team', 'sagas.authors');
        $this->include('saga', 'sagas.team', 'sagas.authors');

        return $this->item($genre, new GenreTransformer);
    }
}
