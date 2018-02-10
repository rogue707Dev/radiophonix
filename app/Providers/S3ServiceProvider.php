<?php

namespace Radiophonix\Providers;

use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;

class S3ServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->app->bind(S3Client::class, function () {
            return new S3Client([
                'credentials' => [
                    'key' => config('services.s3.key'),
                    'secret' => config('services.s3.secret'),
                ],
                'region' => config('services.s3.region'),
                'version' => 'latest',
            ]);
        });
    }
}
