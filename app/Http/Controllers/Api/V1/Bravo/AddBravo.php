<?php

namespace Radiophonix\Http\Controllers\Api\V1\Bravo;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Bravo;
use Radiophonix\Models\Saga;
use Symfony\Component\HttpFoundation\Response;

class AddBravo extends ApiController
{
    /**
     * @param Saga $saga
     * @return Response
     */
    public function __invoke(Saga $saga)
    {
        if ($saga->visibility != Saga::VISIBILITY_PUBLIC) {
            throw new ModelNotFoundException;
        }

        $bravo = Bravo::where('user_id', '=', $this->user()->id)
            ->where('saga_id', $saga->id)
            ->first();

        if ($bravo != null) {
            return $this->ok();
        }

        $bravo = new Bravo;

        $bravo->saga()->associate($saga);
        $bravo->user()->associate($this->user());

        $bravo->save();

        return $this->ok();
    }
}
