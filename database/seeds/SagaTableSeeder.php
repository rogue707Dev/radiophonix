<?php

use Radiophonix\Models\Author;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

class SagaTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        /** @var User $user */
        foreach ($users as $user) {
            /** @var Author $author */
            $author = factory(Author::class)->create();
            $author->owner()->associate($user);
            $author->save();

            factory(Saga::class)->create([
                'name' => $this->faker->name,
                'visibility' => Saga::VISIBILITY_PUBLIC,
                'author_id' => $author->id,
            ]);
        }
    }
}
