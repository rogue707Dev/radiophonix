<?php

use Radiophonix\Models\User;

class TestingUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'user-1',
        ]);

        factory(User::class)->create([
            'name' => 'user-2',
        ]);
    }
}
