<?php

use Illuminate\Database\Eloquent\Model;

class TestingDatabaseSeeder extends TestingSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(TestingUsersTableSeeder::class);
        $this->call(TestingSagasTableSeeder::class);
        $this->call(TestingCollectionsTableSeeder::class);

        Model::reguard();
    }
}
