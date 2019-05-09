<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Radiophonix\Models\Collection;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
    ];
});
