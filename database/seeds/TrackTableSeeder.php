<?php

use Radiophonix\Models\Album;
use Radiophonix\Models\Track;

class TrackTableSeeder extends Seeder
{
    public function run()
    {
        $albums = Album::all();

        foreach ($albums as $album) {
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

                $track->album()->associate($album);
                $track->save();
            }
        }
    }
}
