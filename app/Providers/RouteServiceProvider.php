<?php

namespace Radiophonix\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Route;
use Radiophonix\Models\Author;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Genre;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Team;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Radiophonix\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('saga', function ($value) {
            // We can query sagas using a slug or an hashid
            return Saga::findFromSlugOrFakeId($value);
        });

        Route::bind('collection', function ($value) {
            return Collection::fromFakeId($value);
        });

        Route::bind('track', function ($value) {
            return Track::fromFakeId($value);
        });

        Route::bind('user', function ($value) {
            return User::fromFakeId($value);
        });

        Route::bind('team', function ($value) {
            return Team::fromFakeId($value);
        });

        Route::bind('genre', function ($value) {
            return Genre::fromFakeId($value);
        });

        Route::bind('author', function ($value) {
            return Author::findFromSlugOrFakeId($value);
        });

        Route::bind('notification', function ($value) {
            return DatabaseNotification::findOrFail($value);
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();

        Route::any(
            '{any}',
            function () {
                return file_get_contents(__DIR__ . '/../../public/index.html');
            }
        )->where('any', '.*');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['bindings', 'cors'])
            ->group(base_path('routes/api.php'));
    }
}
