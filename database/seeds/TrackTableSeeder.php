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
                    'chapters' => $this->createChapters($length),
                    'percentages' => $this->createPercentages(),
                ]);

                $track->collection()->associate($collection);
                $track->save();
            }
        }
    }

    private function createChapters($maxLength)
    {
        $minimum = 0;
        $chapters = [];

        while ($minimum < $maxLength) {
            $chapters[] = [
                'title' => $this->faker->paragraph(1),
                'start_at' => $minimum
            ];

            $minimum = $this->faker->numberBetween(++$minimum, $maxLength);
        }

        return $chapters;
    }

    private function createPercentages()
    {
        return $this->faker->randomElements(
            [
                ['title' => 'Ecriture', 'value' => $this->faker->numberBetween(0, 100)],
                ['title' => 'Enregistrement', 'value' => $this->faker->numberBetween(0, 100)],
                ['title' => 'Musique', 'value' => $this->faker->numberBetween(0, 100)],
                ['title' => 'Mixage', 'value' => $this->faker->numberBetween(0, 100)],
            ],
            $this->faker->numberBetween(2, 4)
        );
    }
}
