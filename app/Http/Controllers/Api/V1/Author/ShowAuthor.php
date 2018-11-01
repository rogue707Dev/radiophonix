<?php

namespace Radiophonix\Http\Controllers\Api\V1\Author;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\AuthorTransformer;
use Radiophonix\Models\Author;

class ShowAuthor extends ApiController
{
    /**
     * Get an Author
     *
     * @param Author $author
     * @return ApiResponse
     */
    public function __invoke(Author $author)
    {
        $author->load('sagas', 'sagas.authors', 'sagas.team', 'teams');
        $this->include('sagas', 'sagas.authors', 'sagas.team', 'teams');

        return $this->item($author, new AuthorTransformer);
    }
}
