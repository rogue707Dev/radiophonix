<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Radiophonix\Models\Collection;
use Radiophonix\Models\User;
use Tests\TestCase;

abstract class V1TestCase extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $currentUser;

    protected $allSagas = [
        'saga1-public',
        'saga1-hidden',
        'saga1-private',
        'saga2-public',
        'saga2-hidden',
        'saga2-private',
    ];

    /**
     * @var Collection[]
     */
    protected $allCollections = [];

    /**
     * @var array
     */
    private $collectionsNames = [
        'saga1-public-collection1',
        'saga1-public-collection2',

        'saga1-hidden-collection1',
        'saga1-hidden-collection2',

        'saga1-private-collection1',
        'saga1-private-collection2',

        'saga2-public-collection1',
        'saga2-public-collection2',

        'saga2-hidden-collection1',
        'saga2-hidden-collection2',

        'saga2-private-collection1',
        'saga2-private-collection2',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->seed('TestingDatabaseSeeder');

        $this->allCollections = Collection::whereIn('name', $this->collectionsNames)
            ->get()
            ->keyBy('name')
            ->all();
    }

    /**
     * @param int|null $userId
     * @return static
     */
    protected function login($userId)
    {
        $this->currentUser = null;

        if (null !== $userId) {
            $user = User::where('name', '=', 'user-' . $userId)
                ->firstOrFail();

            $this->currentUser = $user;
        }

        return $this;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $data
     * @param string $version
     * @return TestResponse
     */
    protected function api(string $method, string $path, array $data = [], string $version = 'v1')
    {
        $headers = [];

        if ($this->currentUser instanceof User) {
            $headers = ['Authorization' => 'Bearer ' . \JWTAuth::fromUser($this->currentUser)];
        }

        return $this->json($method, '/api/' . $version . str_start($path, '/'), $data, $headers);
    }
}
