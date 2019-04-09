<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Like;
use Radiophonix\Models\Saga;
use Symfony\Component\HttpFoundation\Response;

class AddLike extends ApiController
{
    /**
     * @param Saga $saga
     * @return Response
     */
    public function __invoke(Saga $saga)
    {
        $like = Like::where('user_id', '=', $this->user()->id)
            ->where('saga_id', $saga->id)
            ->first();

        if ($like != null) {
            return $this->ok();
        }

        $like = new Like;

        $like->saga()->associate($saga);
        $like->user()->associate($this->user());

        $like->save();

        return $this->ok();
    }
}
