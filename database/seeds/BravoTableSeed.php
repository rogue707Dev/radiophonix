<?php

use Radiophonix\Models\Bravo;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

class BravoTableSeeder extends Seeder
{
    public function run()
    {
        $sagas = Saga::all();

        $users = User::all();

        foreach ($sagas as $saga) {
            $randomUsers = $users
                ->random(
                    $this->faker->numberBetween(1, $users->count())
                );

            foreach ($randomUsers as $randomUser) {
                $bravo = new Bravo;

                $bravo->user()->associate($randomUser);
                $bravo->saga()->associate($saga);
                $bravo->save();
            }
        }
    }
}
