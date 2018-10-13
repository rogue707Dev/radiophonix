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
            Saga::VISIBILITY_PUBLIC,
            $author1
        );

//        $this->createSaga(
//            'Saga1_Hidden',
//            Saga::VISIBILITY_HIDDEN,
//            $author1
//        );
//
//        $this->createSaga(
//            'Saga1_Private',
//            Saga::VISIBILITY_PRIVATE,
//            $author1
//        );

        $this->createSaga(
            'Saga2_Public',
            Saga::VISIBILITY_PUBLIC,
            $author2
        );

//        $this->createSaga(
//            'Saga2_Hidden',
//            Saga::VISIBILITY_HIDDEN,
//            $author2
//        );
//
//        $this->createSaga(
//            'Saga2_Private',
//            Saga::VISIBILITY_PRIVATE,
//            $author2
//        );
    }

    /**
     * @param string $name
     * @param int $visibility
     * @param Author $author
     */
    private function createSaga(string $name, int $visibility, Author $author)
    {
        /** @var Saga $saga */
        $saga = factory(Saga::class)
            ->create([
                'name' => $name,
                'visibility' => $visibility,
            ]);

        $saga->authors()->save($author);
    }
}
