<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Radiophonix\Models\Album;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
    ];
});
