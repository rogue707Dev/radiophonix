<?php

namespace Radiophonix\Http\Controllers\Api\V1\Bravo;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Bravo;
use Radiophonix\Models\Saga;
use Symfony\Component\HttpFoundation\Response;

class RemoveBravo extends ApiController
{
    /**
     * @param Saga $saga
     * @return Response
     * @throws \Exception
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
            $bravo->delete();
        }

        return $this->ok();
    }
}
