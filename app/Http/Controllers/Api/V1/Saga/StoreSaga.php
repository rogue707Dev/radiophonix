<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateSagaRequest;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Repositories\SagaRepository;

class StoreSaga extends ApiController
{
    /**
     * @var SagaRepository
     */
    private $repository;

    /**
     * @param SagaRepository $repository
     */
    public function __construct(SagaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateSagaRequest $request
     * @return ApiResponse
     */
    public function __invoke(CreateSagaRequest $request)
    {
        $saga = $this->repository->create($request);

        return $this->item($saga, new SagaTransformer);
    }
}
