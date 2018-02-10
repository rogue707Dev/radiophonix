<?php

namespace Tests\Feature\Api\V1\Sagas;

use Tests\Feature\Api\V1\V1TestCase;

class SagasApiReadTest extends V1TestCase
{
    public function listAllSagasDataProvider()
    {
        return [
            [
                'user' => null,
                'visibles' => [
                    'saga1-public',
                    'saga2-public',
                ],
            ],
            [
                'user' => 1,
                'visibles' => [
                    'saga1-public',
                    'saga1-hidden',
                    'saga1-private',
                    'saga2-public',
                ],
            ],
            [
                'user' => 2,
                'visibles' => [
                    'saga1-public',
                    'saga2-public',
                    'saga2-hidden',
                    'saga2-private',
                ],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider listAllSagasDataProvider
     * @param int $user
     * @param array $visibleSagas
     */
    public function can_list_sagas($user, array $visibleSagas)
    {
        $this->login($user);

        $response = $this->api('GET', '/sagas');

        foreach ($visibleSagas as $visibleSaga) {
            $response->assertJsonFragment([
                'slug' => $visibleSaga,
            ]);
        }

        $notVisibleSagas = array_diff($this->allSagas, $visibleSagas);

        foreach ($notVisibleSagas as $notVisibleSaga) {
            $response->assertJsonMissing([
                'slug' => $notVisibleSaga,
            ]);
        }
    }

    public function showOneSagaDataProvider()
    {
        return [
            [
                'user' => null,
                'saga' => 'saga1-public',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'saga' => 'saga1-hidden',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'saga' => 'saga1-private',
                'shouldBeVisible' => false,
            ],
            [
                'user' => 1,
                'saga' => 'saga1-public',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'saga' => 'saga1-hidden',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'saga' => 'saga1-private',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'saga' => 'saga1-public',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'saga' => 'saga1-hidden',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'saga' => 'saga1-private',
                'shouldBeVisible' => false,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider showOneSagaDataProvider
     *
     * @param $user
     * @param string $sagaSlug
     * @param bool $shouldBeVisible
     */
    public function can_query_one_saga($user, string $sagaSlug, bool $shouldBeVisible)
    {
        $this->login($user);

        $response = $this->api('GET', '/sagas/' . $sagaSlug);

        if (false === $shouldBeVisible) {
            $response->assertStatus(404);
        } else {
            $response->assertJsonFragment([
                'slug' => $sagaSlug,
            ]);
        }
    }
}
