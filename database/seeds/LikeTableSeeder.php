<?php

use Radiophonix\Models\Like;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

class LikeTableSeeder extends Seeder
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
                $like = new Like;

                $like->user()->associate($randomUser);
                $like->saga()->associate($saga);
                $like->save();
            }
        }
    }
}
