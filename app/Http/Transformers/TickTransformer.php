<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Tick;

class TickTransformer extends Transformer
{
    protected $defaultIncludes = [
        'track',
    ];

    /**
     * @param Tick $tick
     * @return array
     */
    public function transform(Tick $tick)
    {
        return [
            'progress' => (int)$tick->progress,
        ];
    }

    /**
     * @param Tick $tick
     * @return Item
     */
    public function includeTrack(Tick $tick)
    {
        return $this->item($tick->track, new TrackTransformer);
    }
}
