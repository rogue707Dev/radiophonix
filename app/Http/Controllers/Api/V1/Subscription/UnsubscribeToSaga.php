<?php

namespace Radiophonix\Http\Controllers\Api\V1\Subscription;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;

class UnsubscribeToSaga extends ApiController
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

        $subscription = Subscription::where('user_id', '=', $this->user()->id)
            ->where('saga_id', '=', $saga->id)
            ->first();

        if ($subscription != null) {
            $subscription->delete();
        }

        return $this->ok();
    }
}
