<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Like;
use Radiophonix\Models\Saga;
use Symfony\Component\HttpFoundation\Response;

class RemoveLike extends ApiController
{
    /**
     * @param Saga $saga
     * @return Response
     * @throws \Exception
     */
    public function __invoke(Saga $saga)
    {
        /** @var Like $like */
        $like = Like::where('user_id', '=', $this->user()->id)
            ->where('saga_id', $saga->id)
            ->first();

        if ($like != null) {
            $like->delete();
        }

        return $this->ok();
    }
}
