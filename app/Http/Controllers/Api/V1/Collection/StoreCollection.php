<?php

namespace Radiophonix\Http\Controllers\Api\V1\Collection;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateCollectionRequest;
use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;

class StoreCollection extends ApiController
{
    /**
     * @param CreateCollectionRequest $request
     * @param Saga $saga
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(CreateCollectionRequest $request, Saga $saga)
    {
        $this->authorize('create', [Collection::class, $saga]);

        $collection = new Collection;

        $collection->fill($request->only($collection->getFillable()));

        $collection->saga()->associate($saga);

        // todo this should be done somewhere else
        // We grab the highest sort value and increment it
        $lastSort = $saga->collections->max('sort');
        $collection->sort = ++$lastSort;

        $collection->save();

        return $this->item($collection, new CollectionTransformer);
    }
}
