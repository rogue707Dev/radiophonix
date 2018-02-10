<?php

namespace Tests\Feature\Api\V1\Collections;

use Tests\Feature\Api\V1\V1TestCase;

class CollectionsApiReadTest extends V1TestCase
{
    public function listCollectionsDataProvider()
    {
        return [
            [
                'user' => null,
                'saga' => 'saga1-public',
                'visibles' => [
                    'saga1-public-collection1',
                    'saga1-public-collection2',
                ],
            ],
            [
                'user' => null,
                'saga' => 'saga1-hidden',
                'visibles' => [
                    'saga1-hidden-collection1',
                    'saga1-hidden-collection2',
                ],
            ],
            [
                'user' => null,
                'saga' => 'saga1-private',
                'visibles' => false,
            ],

            [
                'user' => 1,
                'saga' => 'saga1-public',
                'visibles' => [
                    'saga1-public-collection1',
                    'saga1-public-collection2',
                ],
            ],
            [
                'user' => 1,
                'saga' => 'saga1-hidden',
                'visibles' => [
                    'saga1-hidden-collection1',
                    'saga1-hidden-collection2',
                ],
            ],
            [
                'user' => 1,
                'saga' => 'saga1-private',
                'visibles' => [
                    'saga1-private-collection1',
                    'saga1-private-collection2',
                ],
            ],

            [
                'user' => 2,
                'saga' => 'saga1-public',
                'visibles' => [
                    'saga1-public-collection1',
                    'saga1-public-collection2',
                ],
            ],
            [
                'user' => 2,
                'saga' => 'saga1-hidden',
                'visibles' => [
                    'saga1-hidden-collection1',
                    'saga1-hidden-collection2',
                ],
            ],
            [
                'user' => 2,
                'saga' => 'saga1-private',
                'visibles' => false,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider listCollectionsDataProvider
     *
     * @param $user
     * @param string $saga
     * @param array|bool $visibleCollections
     */
    public function can_list_collections($user, $saga, $visibleCollections)
    {
        $this->login($user);

        $response = $this->api(
            'GET',
            '/sagas/' . $saga . '/collections'
        );

        if (false === $visibleCollections) {
            $response->assertStatus(404);
            return;
        }

        foreach ($visibleCollections as $visibleCollection) {
            $response->assertJsonFragment([
                'name' => $visibleCollection,
            ]);
        }

        $notVisibleCollections = array_diff(array_keys($this->allCollections), $visibleCollections);

        foreach ($notVisibleCollections as $notVisibleCollection) {
            $response->assertJsonMissing([
                'name' => $notVisibleCollection,
            ]);
        }
    }

    public function showOneSagaDataProvider()
    {
        return [
            [
                'user' => null,
                'collection' => 'saga1-public-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'collection' => 'saga1-public-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'collection' => 'saga1-hidden-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'collection' => 'saga1-hidden-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => null,
                'collection' => 'saga1-private-collection1',
                'shouldBeVisible' => false,
            ],
            [
                'user' => null,
                'collection' => 'saga1-private-collection2',
                'shouldBeVisible' => false,
            ],

            [
                'user' => 1,
                'collection' => 'saga1-public-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'collection' => 'saga1-public-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'collection' => 'saga1-hidden-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'collection' => 'saga1-hidden-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'collection' => 'saga1-private-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 1,
                'collection' => 'saga1-private-collection2',
                'shouldBeVisible' => true,
            ],

            [
                'user' => 2,
                'collection' => 'saga1-public-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'collection' => 'saga1-public-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'collection' => 'saga1-hidden-collection1',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'collection' => 'saga1-hidden-collection2',
                'shouldBeVisible' => true,
            ],
            [
                'user' => 2,
                'collection' => 'saga1-private-collection1',
                'shouldBeVisible' => false,
            ],
            [
                'user' => 2,
                'collection' => 'saga1-private-collection2',
                'shouldBeVisible' => false,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider showOneSagaDataProvider
     *
     * @param $user
     * @param string $collectionName
     * @param bool $shouldBeVisible
     */
    public function can_query_one_collection($user, string $collectionName, bool $shouldBeVisible)
    {
        $this->login($user);

        $response = $this->api('GET', '/collections/' . $this->allCollections[$collectionName]->fakeId());

        if (false === $shouldBeVisible) {
            $response->assertStatus(404);
        } else {
            $response->assertJsonFragment([
                'name' => $collectionName,
            ]);
        }
    }
}
