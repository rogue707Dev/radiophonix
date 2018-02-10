<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Saga;

class ListSagaCollections extends ApiController
{
    /**
     * @param Saga $saga
     * @return ApiResponse
     */
    public function __invoke(Saga $saga)
    {
        $saga->load('collections.tracks');

        $transformer = new CollectionTransformer;
        $transformer->setDefaultIncludes(['tracks']);

        return $this->collection($saga->collections, $transformer);
    }
}
