<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'authors',
        'likes',
        'albums',
        'genre_saga',
        'genres',
        'invites',
        'media',
        'notifications',
        'password_resets',
        'sagas',
        'subscriptions',
        'team_user',
        'teams',
        'ticks',
        'tracks',
        'users',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        Eloquent::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(SagaTableSeeder::class);
        $this->call(AlbumTableSeeder::class);
        $this->call(TrackTableSeeder::class);
        $this->call(LikeTableSeeder::class);

        Eloquent::reguard();
    }

    public function cleanDatabase()
    {
        DB::statement('set foreign_key_checks = 0;');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('set foreign_key_checks = 1;');
    }
}
