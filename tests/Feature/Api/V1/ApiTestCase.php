<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection as LaravelCollection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    use RefreshDatabase;

    /**
     * @param mixed $data
     * @param Transformer $transformer
     * @return array
     */
    protected function transformItem($data, Transformer $transformer): array
    {
        return app(Manager::class)
            ->createData(new Item($data, $transformer))
            ->toArray();
    }

    /**
     * @param array|LaravelCollection|Arrayable $items
     * @param Transformer $transformer
     * @return array
     */
    protected function transformCollection($items, Transformer $transformer): array
    {
        if ($items instanceof LaravelCollection) {
            $items = $items->all();
        }

        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        return app(Manager::class)
            ->createData(new FractalCollection($items, $transformer))
            ->toArray();
    }
}
