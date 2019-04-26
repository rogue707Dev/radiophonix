<?php

namespace Radiophonix\Http\Controllers\Api\V1\Search;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\SearchRequest;
use Radiophonix\Http\Transformers\AuthorTransformer;
use Radiophonix\Http\Transformers\GenreTransformer;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Http\Transformers\SearchTransformer;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Author;
use Radiophonix\Models\Genre;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Track;
use Radiophonix\Search\SearchResult;

class SearchAllController extends ApiController
{
    /**
     * @param SearchRequest $request
     * @return ApiResponse
     */
    public function __invoke(SearchRequest $request)
    {
        $query = $request->get('query');
        $searchResult = new SearchResult;

        try {
            $sagas = $this->searchSagas($query);

            $searchResult->addResultSet('sagas', $sagas, new SagaTransformer);
        } catch (QueryException $e) {
            \Log::critical('Missing MySQL search index for SAGAS');
        }

        try {
            $authors = $this->searchAuthors($query);

            $searchResult->addResultSet('authors', $authors, new AuthorTransformer);
        } catch (QueryException $e) {
            \Log::critical('Missing MySQL search index for AUTHORS');
        }

        try {
            $genres = $this->searchGenres($query);

            $searchResult->addResultSet('genres', $genres, new GenreTransformer);
        } catch (QueryException $e) {
            \Log::critical('Missing MySQL search index for GENRES');
        }

        try {
            $tracks = $this->searchTracks($query);

            $searchResult->addResultSet(
                'tracks',
                $tracks,
                (new TrackTransformer)->setDefaultIncludes(['collection'])
            );
        } catch (QueryException $e) {
            \Log::critical('Missing MySQL search index for COLLECTIONS');
        }

        return $this->item($searchResult, new SearchTransformer);
    }

    /**
     * @param $query
     * @return Collection
     */
    private function searchSagas($query): Collection
    {
        return Saga::search($query)->get();
    }

    /**
     * @param $query
     * @return Collection
     */
    private function searchAuthors($query): Collection
    {
        $authors = Author::search($query)->get();

        $authors->load('teams');

        return $authors;
    }

    /**
     * @param $query
     * @return Collection
     */
    private function searchGenres($query): Collection
    {
        $genres = Genre::search($query)->get();

        return $genres;
    }

    /**
     * @param $query
     * @return Collection
     */
    private function searchTracks($query): Collection
    {
        $tracks = Track::search($query)
            // We only want published tracks
//            ->where('published_at', '>=', Carbon::now())
            ->get()
            // Each track's collection and saga will be included in the
            // response
            ->load('collection.saga');

        return $tracks;
    }
}
