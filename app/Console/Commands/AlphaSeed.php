<?php

namespace Radiophonix\Console\Commands;

use Carbon\Carbon;
use DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Radiophonix\Models\Author;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Genre;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Team;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;

class AlphaSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alpha:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import de données pour l\'alpha';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Eloquent::unguard();

        $this->seedTeams();

        $this->info('');

        $this->seedAuthors();

        $imports = $this->loadJsonFiles('sagas');

        $this->info('');
        $this->output->write('Sagas');

        $genres = [];

        $imports->each(function ($importSaga) use (&$genres) {
            $importSaga['creation_date'] = $this->parseDate($importSaga['creation_date']);

//            $this->info('');
//            $this->info('==================================');
//            $this->info('[SAGA] ' . $importSaga['name']);

            $saga = new Saga();

            $saga->fill(
                Arr::only($importSaga, $saga->getFillable())
            );

            if (isset($importSaga['slug'])) {
                $saga->slug = $importSaga['slug'];
            }

            collect($importSaga['links'])
                ->each(function ($link, $name) use ($saga) {
                    $property = 'link_' . $name;
                    $saga->$property = $link;
                });

            $saga->visibility = Saga::VISIBILITY_PUBLIC;
            $saga->save();

            collect($importSaga['authors'])
                ->each(function($authorName) use ($saga) {
                    $author = Author::where('name', '=', $authorName)->first();

                    $saga->authors()->save($author);
                });

            if (isset($importSaga['team'])) {
                $team = Team::query()->where('name', $importSaga['team'])->first();

                $saga->team()->associate($team);
                $saga->save();
            }

            collect($importSaga['images'])
                ->filter(function ($image) {
                    $exists = Storage::disk('alpha')->exists('images/sagas/' . $image);

                    if (!$exists) {
                        $this->warn("\t[MEDIA][NOT FOUND] $image");
                    }

                    return $exists;
                })
                ->each(function ($image, $name) use ($saga) {
                    $filePath = Storage::disk('alpha')->url('images/sagas/' . $image);
//                    $this->info("\t[MEDIA] Saga::$name ($filePath)");

                    $saga->addMedia($filePath)
                        ->withCustomProperties(['colors' => true])
                        ->preservingOriginal()
                        ->toMediaCollection($name);

                });

            collect($importSaga['collections'])
                ->each(function ($importCollection) use ($saga) {
//                    $this->info("\t[COLLECTION] " . $importCollection['name']);

                    $collection = new Collection();

                    $collection->fill(Arr::only($importCollection, $collection->getFillable()));
                    $collection->saga()->associate($saga);
                    $collection->save();

                    collect($importCollection['tracks'])
                        ->each(function (array $importTrack) use ($collection) {
//                            $this->info("\t\t[TRACK] " . $importTrack['title'], 'v');

                            $track = new Track();

                            if (substr($importTrack['file'], 0, 4) != 'http') {
                                $importTrack['url'] = 'https://audio.radiophonix.org/' . $importTrack['file'];
                            } else {
                                $importTrack['url'] = $importTrack['file'];
                            }

                            preg_match('#(?:([0-9]+)h)?(?:([0-9]+)m(?:in)?)?(?:([0-9]+)s)?#', $importTrack['seconds'], $matches);

                            if (count($matches) >= 2) {
                                $hours = (int)($matches[1] ?? 0);
                                $minutes = (int)($matches[2] ?? 0);
                                $seconds = (int)($matches[3] ?? 0);

                                $importTrack['seconds'] = ($hours * 60 * 60) + ($minutes * 60) + $seconds;
                            }

                            $importTrack['length'] = $importTrack['seconds'];
                            $importTrack['published_at'] = $this->parseDate($importTrack['published_at']);

                            $track->fill(Arr::only($importTrack, $track->getFillable()));
                            $track->collection()->associate($collection);
                            $track->save();
                        });
                });

            collect($importSaga['genres'])
                ->each(function (string $importGenre) use (&$genres, $saga) {
                    /** @var Genre $genre */
                    $genre = Genre::where('name', '=', $importGenre)
                        ->firstOrNew([
                            'name' => $importGenre,
                        ]);

                    if (!$genre->exists) {
                        $genres[] = $importGenre;

                        $exists = Storage::disk('alpha')->exists('images/genres/' . $importGenre . '.jpeg');

                        if (!$exists) {
                            $this->warn("\t[MEDIA][NOT FOUND] images/genres/$importGenre.jpeg");
                        } else {
                            $genreImage = Storage::disk('alpha')->url('images/genres/' . $importGenre . '.jpeg');

                            $genre->addMedia($genreImage)
                                ->preservingOriginal()
                                ->toMediaCollection('image');
                        }
                    }

                    $genre->save();

                    $saga->genres()->save($genre);
                });

            $this->output->write('.');
        });

        $this->info('');

        \Eloquent::reguard();

        return true;
    }

    /**
     * @param $date
     * @return Carbon
     */
    private function parseDate($date)
    {
        return Carbon::parse($date);
    }

    /**
     * @param $path
     * @return \Illuminate\Support\Collection
     */
    private function loadJsonFiles($path)
    {
        return collect(Storage::disk('alpha')->files('seeds/' . $path))
            ->filter(function ($path) {
                return substr($path, -5) === '.json';
            })
            ->map(function ($path) {
                return json_decode(
                    Storage::disk('alpha')->get($path),
                    true
                );
            });
    }

    private function seedTeams(): void
    {
        $this->output->write('Equipes');

        $this->loadJsonFiles('teams')
            ->each(function($teamData) {
                $rand = rand(1, 1000);

                $user = User::create([
                    'name' => 'User_' . $rand,
                    'email' => 'user_' . $rand . '@radiophonix.org',
                    'password' => bcrypt(Str::random(32)),
                ]);

                $team = new Team();
                $team->name = $teamData['name'];
                $team->bio = $teamData['bio'];

                collect($teamData['links'])
                    ->each(function ($link, $name) use ($team) {
                        $property = 'link_' . $name;
                        $team->$property = $link;
                    });

                $team->owner()->associate($user);
                $team->save();

                if (empty($teamData['picture'])) {
                    $teamData['picture'] = 'author.jpg';
                }

                $filePath = Storage::disk('alpha')->url('images/authors/' . $teamData['picture']);

                $team->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection('picture');

                $this->output->write('.');
            });
    }

    private function seedAuthors(): void
    {
        $authors = $this->loadJsonFiles('authors');

        $this->output->write('Faiseurs');

        $authors->each(function ($authorData) {
            /** @var User $user */
            $user = User::where('name', '=', $authorData['name'])
                ->firstOrNew([
                    'name' => $authorData['name'],
                    'email' => 'author_' . rand(1, 100) . '_' . Str::slug($authorData['name']) . '@radiophonix.org',
                    'password' => bcrypt(Str::random(32)),
                ]);

            $user->save();

            $author = new Author();
            $author->name = $authorData['name'];
            $author->bio = $authorData['bio'] ?? '';

            $author->user()->associate($user);

            collect($authorData['links'])
                ->each(function ($link, $name) use ($author) {
                    $property = 'link_' . $name;
                    $author->$property = $link;
                });

            $author->save();

            if (empty($authorData['picture'])) {
                $authorData['picture'] = 'author.jpg';
            }

            $filePath = Storage::disk('alpha')->url('images/authors/' . $authorData['picture']);

            $author->addMedia($filePath)
                ->preservingOriginal()
                ->toMediaCollection('picture');

            $this->output->write('.');
        });
    }
}
