<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Radiophonix\Models\SiteInvite;

$factory->define(SiteInvite::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'email' => $faker->safeEmail,
    ];
});
