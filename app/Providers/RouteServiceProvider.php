<?php

namespace Radiophonix\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Route;
use Radiophonix\Http\Controllers\IndexController;
use Radiophonix\Models\Author;
use Radiophonix\Models\Album;
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
            return Saga::findFromSlugOrUuid($value);
        });

        Route::bind('album', function ($value) {
            return Album::fromUuId($value);
        });

        Route::bind('track', function ($value) {
            return Track::fromUuId($value);
        });

        Route::bind('user', function ($value) {
            return User::fromNameOrUuid($value);
        });

        Route::bind('team', function ($value) {
            return Team::findFromSlugOrUuid($value);
        });

        Route::bind('genre', function ($value) {
            return Genre::findFromSlugOrUuid($value);
        });

        Route::bind('author', function ($value) {
            return Author::findFromSlugOrUuid($value);
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
        $this->mapRssRoutes();

        // Allows the frontend to work with direct links (since Vuejs is using
        // the html5 mode)
        Route::any('{any}', IndexController::class)
            ->where('any', '.*');
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
        $middlewares = ['web'];

        Route::middleware($middlewares)
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
            ->middleware(['api', 'bindings', 'cors'])
            ->group(base_path('routes/api.php'));
    }

    protected function mapRssRoutes()
    {
        Route::prefix('rss')
            ->middleware(['bindings'])
            ->group(base_path('routes/rss.php'));
    }
}
