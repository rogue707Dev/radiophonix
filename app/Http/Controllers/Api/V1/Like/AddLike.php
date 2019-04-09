<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Like;
use Radiophonix\Models\Saga;
use Radiophonix\Services\FakeId\FakeIdConnection;
use Radiophonix\Services\FakeId\FakeIdManager;

class AddLike extends ApiController
{
    /** @var FakeIdConnection */
    private $fakeIdConnection;

    /**
     * @param FakeIdManager $fakeIdManager
     */
    public function __construct(FakeIdManager $fakeIdManager)
    {
        $this->fakeIdConnection = $fakeIdManager->connection('likes');
    }

    public function __invoke(Saga $saga)
    {
        $like = Like::where('user_id', '=', $this->user()->id)
            ->where('likeable_type', 'saga')
            ->where('likeable_id', $saga->id)
            ->first();

        if ($like != null) {
            return $this->ok();
        }

        $like = new Like;

        $like->likeable()->associate($saga);
        $like->user()->associate($this->user());

        $like->save();

        return $this->ok();
    }
}
