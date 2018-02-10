<?php

namespace Radiophonix\Search;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract;
use Radiophonix\Http\Transformers\Support\Transformer;

class SearchResult
{
    /**
     * @var Collection
     */
    private $resultSets;

    public function __construct() {
        $this->resultSets = new Collection();
    }

    /**
     * @param string $key
     * @param Collection $resultSet
     * @param Transformer $transformer
     * @return $this
     */
    public function addResultSet(string $key, Collection $resultSet, Transformer $transformer)
    {
        $this->resultSets->put($key, new ResultSet($key, $resultSet, $transformer));

        return $this;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->resultSets;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->resultSets->has($key) && $this->get($key)->getResults()->count() > 0;
    }

    public function get(string $key): ResultSet
    {
        return $this->resultSets->get($key);
    }

    /**
     * @return array
     */
    public function keys(): array
    {
        return $this->all()->keys()->toArray();
    }
}
