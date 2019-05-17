<?php

namespace Radiophonix\Console\Commands;

use Artisan;
use Carbon\CarbonInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Radiophonix\Models\Author;
use Radiophonix\Models\Badge;
use Radiophonix\Models\Album;
use Radiophonix\Models\Genre;
use Radiophonix\Models\Saga;
use Radiophonix\Models\SiteInvite;
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

        $this->seedUsers();
        $this->info('');

        $this->seedTeams();
        $this->info('');

        $this->seedAuthors();
        $this->info('');

        $this->seedSagas();
        $this->info('');

        $this->seedBadges();
        $this->info('');

        $this->seedSiteInvites();
        $this->info('');

        \Eloquent::reguard();

        return true;
    }

    private function seedSagas()
    {
        $imports = $this->loadJsonFiles('sagas');

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

            $saga->save();

            collect($importSaga['authors'])
                ->each(function ($authorName) use ($saga) {
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

                    $saga->saveCoverImage($filePath);

                });

            collect($importSaga['albums'])
                ->each(function ($importAlbum) use ($saga) {
                    $album = new Album();

                    $album->fill(Arr::only($importAlbum, $album->getFillable()));
                    $album->saga()->associate($saga);
                    $album->save();

                    collect($importAlbum['tracks'])
                        ->each(function (array $importTrack) use ($album) {
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
                            $track->album()->associate($album);
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
    }

    private function parseDate(?string $date): CarbonInterface
    {
        return Carbon::parse($date);
    }

    /**
     * @param string $path
     * @return \Illuminate\Support\Collection
     */
    private function loadJsonFiles(string $path)
    {
        $data = collect(Storage::disk('alpha')->files('seeds/' . $path))
            ->filter(function ($path) {
                return substr($path, -5) === '.json';
            })
            ->map(function ($path) {
                return json_decode(
                    Storage::disk('alpha')->get($path),
                    true
                );
            });

        return $data->shuffle();
    }

    private function seedUsers(): void
    {
        $this->output->write('Utilisateurs');

        User::create([
            'name' => 'John-Smith',
            'email' => 'john.smith@radiophonix.org',
            'password' => bcrypt('password'),
        ]);
    }

    private function seedTeams(): void
    {
        $this->output->write('Equipes');

        $this->loadJsonFiles('teams')
            ->each(function ($teamData) {
                $slug = Str::slug($teamData['name']);

                $user = User::create([
                    'name' => 'User_' . $slug,
                    'email' => 'user_' . $slug . '@radiophonix.org',
                    'password' => bcrypt('password'),
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

        $this->output->write('Auteurs');

        $authors->each(function ($authorData) {
            /** @var User $user */
            $user = User::where('name', '=', $authorData['name'])
                ->firstOrNew([
                    'name' => $authorData['name'],
                    'email' => 'author_' . Str::slug($authorData['name']) . '@radiophonix.org',
                    'password' => bcrypt('password'),
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

            if (isset($authorData['teams'])) {
                collect($authorData['teams'])
                    ->each(function ($teamName) use ($author) {
                        $team = Team::query()->where('name', $teamName)->first();

                        $author->teams()->save($team);
                    });
            }

            $this->output->write('.');
        });
    }

    private function seedBadges()
    {
        $this->output->write('Badges');

        Artisan::call('badge:sync');

        $user = User::fromNameOrFakeId('John-Smith');
        $user->badges()->attach(Badge::all());

        $this->output->write('.');
    }

    private function seedSiteInvites()
    {
        $this->output->write('Invitation : ');

        /** @var SiteInvite $invite */
        $invite = SiteInvite::query()->create([
            'uuid' => Str::uuid(),
            'email' => 'jane.doe@radiophonix.org',
        ]);

        $this->output->write($invite->uuid);
    }
}
