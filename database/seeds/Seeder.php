<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder as LaravelSeeder;

abstract class Seeder extends LaravelSeeder
{
    /** @var \Faker\Generator */
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }
}
