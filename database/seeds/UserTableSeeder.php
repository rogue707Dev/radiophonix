<?php

use Radiophonix\Models\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->times(10)->create();
    }
}
