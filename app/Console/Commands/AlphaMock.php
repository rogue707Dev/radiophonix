<?php

namespace Radiophonix\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Radiophonix\Http\Transformers\AuthorTransformer;
use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Http\Transformers\GenreTransformer;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Http\Transformers\SearchTransformer;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Author;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Genre;
use Radiophonix\Models\Saga;
use Radiophonix\Search\SearchResult;
use Symfony\Component\Console\Output\ConsoleOutput;

class AlphaMock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alpha:mock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génération des mocks pour le front';

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var FilesystemManager
     */
    protected $storage;

    /**
     * @var Manager
     */
    protected $fractal;

    public function __construct(
        Repository $config,
        FilesystemManager $storage,
        Manager $fractal
    )
    {
        parent::__construct();

        $this->config = $config;
        $this->storage = $storage;
        $this->fractal = $fractal;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('alpha:refresh', [], new ConsoleOutput());

        $this->line('');
        $this->alert('Création des fichiers de mock');

        $this->config->set('app.url', '/static/mocks/media');
        $this->config->set('filesystems.disks.media.url', '/foo');

        $this->storage->disk('mocks')->delete(
            $this->storage->disk('mocks')->allFiles()
        );

        $this->fractal->parseIncludes(['team', 'authors']);

        $sagas = Saga::with('collections', 'authors', 'genres', 'team')
            ->get()
            ->map(function (Saga $saga) {
                $collections = $saga->collections
                    ->map(function (Collection $collection) {
                        $transformer = new CollectionTransformer;

                        $transformer->setDefaultIncludes(['tracks']);

                        return $this->transform($collection, $transformer);
                    })
                    ->all();

                $this->createFile('sagas/' . $saga['slug'] . '/collections.json', $collections);

                $transformer = new SagaTransformer;

                return $this->transform($saga, $transformer);
            })
            ->each(function ($saga) {
                $this->createFile('sagas/' . $saga['slug'] . '/saga.json', $saga);
            })
            ->all();

        $this->createFile('sagas.json', $sagas);

        $authors = Author::with('sagas')
            ->get()
            ->map(function (Author $author) {
                $transformer = new AuthorTransformer;

                return $this->transform($author, $transformer);
            })
            ->each(function ($author) {
                $this->createFile('authors/' . $author['slug'] . '.json', $author);
            });

        $this->createFile(
            'authors.json',
            $authors->all()
        );

        $this->mockSearch();

        $genres = Genre::all();
        $this->createFile(
            'genres.json',
            $genres->map(function (Genre $genre) {
                return $this->transform($genre, new GenreTransformer());
            })->all()
        );

        $path = __DIR__ . '/../../../resources/assets/static/mocks/media/storage/';

        collect($this->storage->disk('public')->allDirectories())
            ->mapWithKeys(function ($file) {
                return [$file => $this->storage->disk('public')->path($file)];
            })
            ->each(function ($file, $to) use ($path) {
                File::copyDirectory($file, $path . $to);
            });

        return true;
    }

    private function mockSearch()
    {
        $transformer = new SearchTransformer();

        $sagas = Saga::take(5)->get();
        $this->createFile(
            'search/saga.json',
            $this->transform(
                (new SearchResult())->addResultSet('sagas', $sagas, new SagaTransformer()),
                $transformer
            )
        );

        $authors = Author::take(5)->get();
        $this->createFile(
            'search/faiseur.json',
            $this->transform(
                (new SearchResult())->addResultSet('authors', $authors, new AuthorTransformer()),
                $transformer
            )
        );

        $genres = Genre::take(5)->get();
        $this->createFile(
            'search/genre.json',
            $this->transform(
                (new SearchResult())->addResultSet('genres', $genres, new GenreTransformer()),
                $transformer
            )
        );

        $saga = Saga::with('collections.tracks')->first();
        $tracks = $saga->collections()->first()->tracks()->get();
        $tracks->load('collection.saga');

        $this->createFile(
            'search/episode.json',
            $this->transform(
                (new SearchResult())->addResultSet('tracks', $tracks, (new TrackTransformer)->setDefaultIncludes(['collection'])),
                $transformer
            )
        );

        $searchResult = new SearchResult();

        $searchResult->addResultSet('sagas', $sagas, new SagaTransformer());
        $this->createFile('search/1.json', $this->transform($searchResult, $transformer));

        $searchResult->addResultSet('authors', $authors, new AuthorTransformer());
        $this->createFile('search/2.json', $this->transform($searchResult, $transformer));

        $searchResult->addResultSet('genres', $genres, new GenreTransformer());
        $this->createFile('search/3.json', $this->transform($searchResult, $transformer));

        $searchResult->addResultSet('tracks', $tracks, (new TrackTransformer)->setDefaultIncludes(['collection']));
        $this->createFile('search/4.json', $this->transform($searchResult, $transformer));
    }

    /**
     * @param $data
     * @param TransformerAbstract $transformer
     * @return array
     */
    private function transform($data, TransformerAbstract $transformer): array
    {
        return $this->fractal->createData(new Item($data, $transformer))->toArray();
    }

    /**
     * @param string $path
     * @param array $data
     */
    private function createFile(string $path, array $data): void
    {
        $file = Str::finish($path, '.json');
        $file = 'data/' . $file;

        if ($this->storage->disk('mocks')->exists($file)) {
            return;
        }

        $path = $this->storage->disk('mocks')->path($file);
        $this->info('[FICHIER] ' . $path);

        $this->storage
            ->disk('mocks')
            ->put(
                $file,
                json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );
    }
}
