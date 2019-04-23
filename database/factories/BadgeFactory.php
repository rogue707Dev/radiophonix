<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Radiophonix\Models\Badge;

$factory->define(Badge::class, function (Faker $faker) {
    return [
        'key' => $faker->uuid,
        'title' => $faker->text(30),
        'description' => $faker->text(150),
    ];
});
