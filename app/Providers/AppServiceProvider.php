<?php

namespace Radiophonix\Providers;

use Gitlab\Client;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use Radiophonix\Domain\Badge\BadgeRegistry;
use Radiophonix\Http\Serializers\ApiSerializer;
use Radiophonix\Models;
use Radiophonix\Models\Support\Observers\TrackObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Models\Track::observe(TrackObserver::class);

        Schema::defaultStringLength(191);

        Relation::morphMap([
            'author' => Models\Author::class,
            'collection' => Models\Collection::class,
            'genre' => Models\Genre::class,
            'invite' => Models\Invite::class,
            'like' => Models\Like::class,
            'media' => Models\Media::class,
            'saga' => Models\Saga::class,
            'subscription' => Models\Subscription::class,
            'team' => Models\Team::class,
            'tick' => Models\Tick::class,
            'track' => Models\Track::class,
            'user' => Models\User::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Manager::class, function () {
            $fractal = new Manager();

            $fractal->setSerializer(new ApiSerializer());

            return $fractal;
        });

        $this->app->singleton(BadgeRegistry::class);

        $this->app->singleton(
            Client::class,
            function () {
                return Client::create('https://gitlab.com')
                    ->authenticate(
                        config('radiophonix.gitlab.token'),
                        Client::AUTH_URL_TOKEN
                    );
            }
        );
    }
}
