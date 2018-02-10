<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Illuminate\Http\Request;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;

class ListSagas extends ApiController
{
    /**
     * List sagas.
     *
     * You can filter results using different parameters:
     *
     * ### Sorting:
     *
     * `?sort=+id,-name`
     *
     * @param Request $request
     *
     * @return ApiResponse
     */
    public function __invoke(Request $request)
    {
        $sagas = Saga::visibles();

        if ($request->has('random')) {
            $sagas = $sagas->inRandomOrder()->limit(10);

            return $this->collection($sagas->get(), new SagaTransformer);
        }

        if ($request->has('sort')) {
            $sagas = $sagas->sortBy($request->get('sort'));
        }

        $sagas = $sagas->filterBy($request->except('sort', 'page', 'include'));

        $sagas = $sagas->paginate();

        return $this->paginator($sagas, new SagaTransformer);
    }
}
