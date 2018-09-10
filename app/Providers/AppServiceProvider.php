<?php

namespace Radiophonix\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use Radiophonix\Http\Serializers\ApiSerializer;
use Radiophonix\Models\Support\Observers\TrackObserver;
use Radiophonix\Models\Track;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Track::observe(TrackObserver::class);

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Manager::class, function () {
            $fractal = new Manager();

            $fractal->setSerializer(new ApiSerializer());

            /** @var Request $request */
            $request = $this->app->make(Request::class);

            if ($request->has('include')) {
                $fractal->parseIncludes($request->get('include'));
            }

            return $fractal;
        });
    }
}
