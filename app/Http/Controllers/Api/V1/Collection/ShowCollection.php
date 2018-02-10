<?php

namespace Radiophonix\Http\Controllers\Api\V1\Collection;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Collection;

class ShowCollection extends ApiController
{
    /**
     * @param Collection $collection
     * @return ApiResponse
     */
    public function __invoke(Collection $collection)
    {
        $transformer = new CollectionTransformer;
        $transformer->setDefaultIncludes(['tracks']);

        return $this->item($collection, $transformer);
    }
}
