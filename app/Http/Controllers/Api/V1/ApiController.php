<?php

namespace Radiophonix\Http\Controllers\Api\V1;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Controller;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\User;
use Tymon\JWTAuth\JWTAuth;

class ApiController extends Controller
{
//    public function __construct()
//    {
//        if (App::environment() == 'testing') {
//            $jwt = app(JWTAuth::class);
//            $jwt->setRequest(Route::getCurrentRequest());
//            /** @noinspection PhpParamsInspection */
//        }
//    }

    /**
     * @param array|string $includes
     */
    protected function include($includes): void
    {
        app(Manager::class)->parseIncludes($includes);
    }

    /**
     * Return an api response for one item.
     *
     * $item can be anything like an object, a model, an array as long as the
     * given transformer is compatible.
     *
     * For example to return a Saga:
     *
     * $this->item($saga, new SagaTransformer);
     *
     * @param $item
     * @param Transformer $transformer
     * @return ApiResponse
     */
    protected function item($item, Transformer $transformer)
    {
        $item = new FractalItem($item, $transformer);

        return new ApiResponse($item);
    }

    /**
     * Return an api response for a list of items.
     *
     * Each item in $collection will be transformed using the given transformer.
     *
     * @param Collection $collection
     * @param Transformer $transformer
     * @return ApiResponse
     */
    protected function collection(Collection $collection, Transformer $transformer)
    {
        $items = new FractalCollection($collection, $transformer);

        return new ApiResponse($items);
    }

    /**
     * Return a paginated api response for a list of items.
     *
     * Each item in $paginator will be transformed using the given transformer.
     *
     * @param LengthAwarePaginator $paginator
     * @param Transformer $transformer
     * @return ApiResponse
     */
    protected function paginator(LengthAwarePaginator $paginator, Transformer $transformer)
    {
        $items = $paginator->items();

        if (empty($items)) {
            return new ApiResponse(['res' => 'pas de résultats'], 404);
        }

        $resource = new FractalCollection($items, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return new ApiResponse($resource);
    }

    /**
     * Return an empty HTTP 204 response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function ok()
    {
        $response = new Response(null);

        return $response->setStatusCode(204);
    }

    /**
     * Return any data as json without using a transformer.
     *
     * @param mixed $data
     * @return ApiResponse
     */
    protected function simple($data)
    {
        return new ApiResponse($data);
    }

    /**
     * Get the current user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|User
     */
    protected function user()
    {
        return Auth::user();
    }
}
