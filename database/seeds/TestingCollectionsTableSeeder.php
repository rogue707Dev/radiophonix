<?php

use Radiophonix\Models\Collection;

class TestingCollectionsTableSeeder extends TestingSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sagas = $this->fetchAllSagas();

        foreach ($sagas as $slug => $saga) {
            for ($i = 1; $i <= 2; $i++) {
                $collection = new Collection;

                $collection->fill([
                    'name' => $slug . '-collection' . $i,
                ]);

                $collection->saga()->associate($saga);

                $collection->save();
            }
        }
    }
}
