<?php

namespace Radiophonix\Http\Controllers\Api\V1\Subscription;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;

class SubscribeToSaga extends ApiController
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

        $subscription = Subscription::where('user_id', $this->user()->id)
            ->where('saga_id', $saga->id)
            ->first();

        if ($subscription != null) {
            // If the user is already subscribed, we just do nothing
            return $this->ok();
        }

        $subscription = new Subscription;

        $subscription->saga()->associate($saga);
        $subscription->user()->associate($this->user());

        $subscription->save();

        return $this->ok();
    }
}
