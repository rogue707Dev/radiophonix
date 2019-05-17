<?php

use Radiophonix\Models\Album;

class AlbumTableSeeder extends Seeder
{
    public function run()
    {
        $sagas = \Radiophonix\Models\Saga::all();

        foreach ($sagas as $saga) {
            for ($i = 1; $i < $this->faker->numberBetween(1, 10); $i++) {
                $album = new Album;

                $album->fill([
                    'name' => 'Saison ' . $i,
                    'type' => $this->faker->randomElement([
                        'Bétisier',
                        'Bonus',
                        'Making of',
                        'Musique',
                        'Saison'
                    ])
                ]);

                $album->sort = $i;
                $album->saga()->associate($saga);
                $album->save();
            }
        }
    }
}
