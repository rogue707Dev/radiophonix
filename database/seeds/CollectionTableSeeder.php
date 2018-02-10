<?php

use Radiophonix\Models\Collection;

class CollectionTableSeeder extends Seeder
{
    public function run()
    {
        $sagas = \Radiophonix\Models\Saga::all();

        foreach ($sagas as $saga) {
            for ($i = 1; $i < $this->faker->numberBetween(1, 10); $i++) {
                $collection = new Collection;

                $collection->fill([
                    'name' => 'Saison ' . $i,
                    'type' => $this->faker->randomElement([
                        'Bétisier',
                        'Bonus',
                        'Making of',
                        'Musique',
                        'Saison'
                    ])
                ]);

                $collection->sort = $i;
                $collection->saga()->associate($saga);
                $collection->save();
            }
        }
    }
}
