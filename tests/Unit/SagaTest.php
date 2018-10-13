<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Radiophonix\Models\Author;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;
use Tests\TestCase;

class SagaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_make_saga_public()
    {
        $saga = factory(Saga::class)->make([
            'visibility' => Saga::VISIBILITY_PUBLIC,
        ]);

        $this->assertTrue($saga->isPublic());
        $this->assertFalse($saga->isHidden());
        $this->assertFalse($saga->isPrivate());
    }

    /** @test */
    public function can_make_saga_hidden()
    {
        $saga = factory(Saga::class)->make([
            'visibility' => Saga::VISIBILITY_HIDDEN,
        ]);

        $this->assertFalse($saga->isPublic());
        $this->assertTrue($saga->isHidden());
        $this->assertFalse($saga->isPrivate());
    }

    /** @test */
    public function can_make_saga_private()
    {
        $saga = factory(Saga::class)->make([
            'visibility' => Saga::VISIBILITY_PRIVATE,
        ]);

        $this->assertFalse($saga->isPublic());
        $this->assertFalse($saga->isHidden());
        $this->assertTrue($saga->isPrivate());
    }

    /** @test */
    public function can_retrieve_saga_from_slug()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        /** @var Saga $sagaFromFactory */
        $sagaFromFactory = factory(Saga::class)->create();
        $sagaFromFactory->authors()->save($author);

        $sagaFromSlug = Saga::fromSlug($sagaFromFactory->slug);

        $this->assertEquals($sagaFromFactory->id, $sagaFromSlug->id);
    }

    /** @test */
    public function saga_generates_slug_from_name()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        /** @var Saga $saga */
        $saga = factory(Saga::class)->create([
            'name' => 'Example name of Saga',
        ]);
        $saga->authors()->save($author);

        $this->assertEquals('example-name-of-saga', $saga->slug);
    }
}
