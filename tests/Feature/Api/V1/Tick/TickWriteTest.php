<?php

namespace Tests\Feature\Api\V1\Tick;

use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class TickWriteTest extends ApiTestCase
{
    /** @test */
    public function cannot_send_tick_without_progress()
    {
        /* *** Initialisation *** */
        /** @var Track $track */
        $track = factory(Track::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid()
            );

        /* *** Assertion *** */
        $response->assertStatus(422);
    }

    /**
     * @test
     * @dataProvider invalidProgressDataProvider
     * @param mixed $progress
     */
    public function cannot_send_tick_with_invalid_progress($progress)
    {
        /* *** Initialisation *** */
        /** @var Track $track */
        $track = factory(Track::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => $progress,
                ]
            );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('progress');
    }

    /**
     * @return array
     */
    public function invalidProgressDataProvider(): array
    {
        return [
            'empty' => [null],
            'negative' => [-1],
            'greater than max' => [100001],
            'float' => [1.1],
            'string' => ['foo'],
        ];
    }

    /**
     * @test
     * @dataProvider validProgressDataProvider
     * @param float $progress
     */
    public function a_user_can_save_a_tick(float $progress)
    {
        /* *** Initialisation *** */
        /** @var Track $track */
        $track = factory(Track::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => $progress,
                ]
            );

        /* *** Assertion *** */
        $response->assertStatus(204);
        $this->assertDatabaseHas(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => $progress,
            ]
        );
    }

    /**
     * @return array
     */
    public function validProgressDataProvider(): array
    {
        return [
            'minimum' => [0],
            'middle' => [10],
            'maximum' => [100000],
        ];
    }

    /** @test */
    public function saving_a_tick_higher_than_a_certain_limit_creates_a_new_record()
    {
        /* *** Initialisation *** */
        /** @var Track $track */
        $track = factory(Track::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $responseHigherThanMinimum = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE + 1,
                ]
            );

        $responseEqualToMinimum = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE,
                ]
            );

        $responseLowerThanMinimum = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 1,
                ]
            );

        /* *** Assertion *** */
        $responseHigherThanMinimum->assertStatus(204);
        $responseEqualToMinimum->assertStatus(204);
        $responseLowerThanMinimum->assertStatus(204);

        $this->assertDatabaseHas(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 1,
            ]
        );

        $this->assertDatabaseHas(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE,
            ]
        );

        $this->assertDatabaseHas(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE + 1,
            ]
        );
    }

    /** @test */
    public function saving_a_tick_lower_than_a_certain_limit_updates_an_existing_record()
    {
        /* *** Initialisation *** */
        /** @var Track $track */
        $track = factory(Track::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $this->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 100,
                ]
            );

        $this->actingAs($user)
            ->json(
                'POST',
                '/api/v1/ticks/' . $track->uuid(),
                [
                    'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 50,
                ]
            );

        /* *** Assertion *** */
        $this->assertDatabaseHas(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 50,
            ]
        );

        $this->assertDatabaseMissing(
            'ticks',
            [
                'user_id' => $user->id,
                'track_id' => $track->id,
                'progress' => Tick::MIN_PROGRESS_TO_BE_COMPLETE - 100,
            ]
        );
    }
}
