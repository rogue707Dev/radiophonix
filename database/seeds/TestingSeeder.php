<?php

use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

abstract class TestingSeeder extends Seeder
{
    /**
     * @param int $num
     * @return User
     */
    protected function fetchUser(int $num)
    {
        return User::where('name', '=', 'user-' . $num)
            ->firstOrFail();
    }

    /**
     * @return Saga[]
     */
    protected function fetchAllSagas()
    {
        return [
            'saga1-public' => Saga::fromSlug('saga1-public'),
            'saga1-hidden' => Saga::fromSlug('saga1-hidden'),
            'saga1-private' => Saga::fromSlug('saga1-private'),
            'saga2-public' => Saga::fromSlug('saga2-public'),
            'saga2-hidden' => Saga::fromSlug('saga2-hidden'),
            'saga2-private' => Saga::fromSlug('saga2-private'),
        ];
    }
}
