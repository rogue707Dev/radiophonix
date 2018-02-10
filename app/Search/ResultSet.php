<?php

namespace Radiophonix\Search;

use Illuminate\Support\Collection;
use Radiophonix\Http\Transformers\Support\Transformer;

class ResultSet
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var Collection
     */
    private $results;

    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * @param string $key
     * @param Collection $results
     * @param Transformer $transformer
     */
    public function __construct($key, Collection $results, Transformer $transformer)
    {
        $this->key = $key;
        $this->transformer = $transformer;
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return Collection
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    /**
     * @return Transformer
     */
    public function getTransformer(): Transformer
    {
        return $this->transformer;
    }
}
