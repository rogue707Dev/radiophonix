<?php

namespace Radiophonix\Http\Controllers\Api\V1\Collection;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\UpdateCollectionRequest;
use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Collection;

class UpdateCollection extends ApiController
{
    /**
     * @param UpdateCollectionRequest $request
     * @param Collection $collection
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateCollectionRequest $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $collection->fill($request->all());

        $collection->save();

        return $this->item($collection, new CollectionTransformer);
    }
}
