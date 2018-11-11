<?php

use Radiophonix\Models\Collection;
use Radiophonix\Models\Track;

class TrackTableSeeder extends Seeder
{
    public function run()
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            for ($i = 1; $i < $this->faker->numberBetween(4, 10); $i++) {
                $track = new Track;

                $length = $this->faker->numberBetween(15, 10000);

                $track->fill([
                    'title' => 'Episode ' . $i,
                    'status' => Track::STATUS_PUBLISHED,
                    'synopsis' => $this->faker->text(800),
                    'published_at' => $this->faker->dateTimeThisDecade(),
                    'length' => $length,
                ]);

                $track->collection()->associate($collection);
                $track->save();
            }
        }
    }
}
