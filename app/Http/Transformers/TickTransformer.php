<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Tick;

class TickTransformer extends Transformer
{
    protected $defaultIncludes = [
        'track',
        'saga',
    ];

    public function transform(Tick $tick): array
    {
        return [
            'progress' => (int)$tick->progress,
        ];
    }

    public function includeTrack(Tick $tick): Item
    {
        return $this->item($tick->track, new TrackTransformer);
    }

    public function includeSaga(Tick $tick): Item
    {
        return $this->item($tick->track->album->saga, new SagaTransformer());
    }
}
