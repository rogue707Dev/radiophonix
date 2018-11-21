<?php

use Radiophonix\Models\Author;
use Radiophonix\Models\Saga;

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

        /** @var Author $author1 */
        $author1 = factory(Author::class)->make();
        /** @var Author $author2 */
        $author2 = factory(Author::class)->make();

        $author1->user()->associate($user1)->save();
        $author2->user()->associate($user2)->save();

        $this->createSaga(
            'Saga1_Public',
            $author1
        );

        $this->createSaga(
            'Saga2_Public',
            $author2
        );
    }

    /**
     * @param string $name
     * @param Author $author
     */
    private function createSaga(string $name, Author $author)
    {
        /** @var Saga $saga */
        $saga = factory(Saga::class)
            ->create([
                'name' => $name,
            ]);

        $saga->authors()->save($author);
    }
}
