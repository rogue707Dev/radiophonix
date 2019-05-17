<?php

namespace Radiophonix\Http\Controllers\Api\V1\Search;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Radiophonix\Domain\Search\SearchResult;
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

class SearchAllController extends ApiController
{
    public function __invoke(SearchRequest $request): ApiResponse
    {
        $query = (string)$request->get('query');
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
                (new TrackTransformer)->setDefaultIncludes(['album'])
            );
        } catch (QueryException $e) {
            \Log::critical('Missing MySQL search index for ALBUMS');
        }

        return $this->item($searchResult, new SearchTransformer);
    }

    private function searchSagas(string $query): Collection
    {
        return Saga::search($query)->get();
    }

    private function searchAuthors(string $query): Collection
    {
        $authors = Author::search($query)->get();

        $authors->load('teams');

        return $authors;
    }

    private function searchGenres(string $query): Collection
    {
        $genres = Genre::search($query)->get();

        return $genres;
    }

    private function searchTracks(string $query): Collection
    {
        $tracks = Track::search($query)
            // We only want published tracks
//            ->where('published_at', '>=', Carbon::now())
            ->get()
            // Each track's album and saga will be included in the
            // response
            ->load('album.saga');

        return $tracks;
    }
}
