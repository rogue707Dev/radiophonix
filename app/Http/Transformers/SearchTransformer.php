<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use Radiophonix\Domain\Search\ResultSet;
use Radiophonix\Domain\Search\SearchResult;
use Radiophonix\Http\Transformers\Support\Transformer;

class SearchTransformer extends Transformer
{
    /**
     * @param SearchResult $searchResult
     * @return array
     */
    public function transform(SearchResult $searchResult)
    {
        $this->setDefaultIncludes($searchResult->keys());

        return [];
    }

    /**
     * @param SearchResult $searchResult
     * @return Collection
     */
    public function includeSagas(SearchResult $searchResult)
    {
        return $this->addInclude($searchResult->get('sagas'));
    }

    /**
     * @param SearchResult $searchResult
     * @return Collection
     */
    public function includeAuthors(SearchResult $searchResult)
    {
        return $this->addInclude($searchResult->get('authors'));
    }

    /**
     * @param SearchResult $searchResult
     * @return Collection
     */
    public function includeGenres(SearchResult $searchResult)
    {
        return $this->addInclude($searchResult->get('genres'));
    }

    /**
     * @param SearchResult $searchResult
     * @return Collection
     */
    public function includeTracks(SearchResult $searchResult)
    {
        return $this->addInclude($searchResult->get('tracks'));
    }

    /**
     * @param ResultSet $set
     * @return Collection
     */
    private function addInclude(ResultSet $set)
    {
        return $this->collection($set->getResults(), $set->getTransformer());
    }
}
