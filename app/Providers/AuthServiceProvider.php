<?php

namespace Radiophonix\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Radiophonix\Http\Guard\JwtGuard;
use Radiophonix\Models\Saga;
use Radiophonix\Policies\SagaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Saga::class => SagaPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->make('auth')->extend('jwt', function (Application $app, $name, array $config) {
            $guard = new JwtGuard(
                $app->make('tymon.jwt'),
                $app->make('auth')->createUserProvider($config['provider']),
                $app->make('request')
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}
