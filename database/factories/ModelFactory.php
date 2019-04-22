<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Radiophonix\Models\Author;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Team;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Saga::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'synopsis' => $faker->text,
        'link_site' => $faker->url,
        'link_netowiki' => $faker->url,
        'link_facebook' => $faker->url,
        'link_twitter' => $faker->url,
        'creation_date' => $faker->dateTimeThisDecade(),
        'licence' => $faker->randomElement(['CC-Zero', 'CC-BY', 'CC-BY-SA']),
    ];
});

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'bio' => $faker->text
    ];
});

$factory->define(Author::class, function (Faker $faker) {
    return [

    ];
});

$factory->define(Track::class, function (Faker $faker) {
    return [];
});

$factory->state(Track::class, 'complete', function (Faker $faker) {
    return [
        'title' => $faker->name,
        'url' => $faker->url,
    ];
});

$factory->state(Track::class, 'publishable', function (Faker $faker) {
    return [
        'title' => $faker->name,
        'url' => $faker->url,
        'published_at' => $faker->dateTimeThisDecade(),
    ];
});

$factory->state(Track::class, 'unpublishable', function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});
