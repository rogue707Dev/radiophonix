<?php

use Radiophonix\Models\Author;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

class TestingSagasTableSeeder extends TestingSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = $this->fetchUser(1);
        $user2 = $this->fetchUser(2);

        $author1 = factory(Author::class)->make();
        $author2 = factory(Author::class)->make();

        $author1->owner()->associate($user1)->save();
        $author2->owner()->associate($user2)->save();

        factory(Saga::class)->create([
            'name' => 'Saga1_Public',
            'visibility' => Saga::VISIBILITY_PUBLIC,
            'author_id' => $author1->id,
        ]);

        factory(Saga::class)->create([
            'name' => 'Saga1_Hidden',
            'visibility' => Saga::VISIBILITY_HIDDEN,
            'author_id' => $author1->id,
        ]);

        factory(Saga::class)->create([
            'name' => 'Saga1_Private',
            'visibility' => Saga::VISIBILITY_PRIVATE,
            'author_id' => $author1->id,
        ]);

        factory(Saga::class)->create([
            'name' => 'Saga2_Public',
            'visibility' => Saga::VISIBILITY_PUBLIC,
            'author_id' => $author2->id,
        ]);

        factory(Saga::class)->create([
            'name' => 'Saga2_Hidden',
            'visibility' => Saga::VISIBILITY_HIDDEN,
            'author_id' => $author2->id,
        ]);

        factory(Saga::class)->create([
            'name' => 'Saga2_Private',
            'visibility' => Saga::VISIBILITY_PRIVATE,
            'author_id' => $author2->id,
        ]);
    }
}
