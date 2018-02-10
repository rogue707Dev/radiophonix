<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Collection;

class CollectionTransformer extends Transformer
{
    protected $availableIncludes = [
        'tracks'
    ];

    /**
     * @param Collection $collection
     * @return array
     */
    public function transform(Collection $collection)
    {
        return [
            'id' => $collection->fakeId(),
            'number' => $collection->number,
            'name' => $collection->name,
            'synopsis' => $collection->synopsis,
            'type' => $collection->type,
            'created_at' => $this->getFormatedDate($collection->created_at),
            'updated_at' => $this->getFormatedDate($collection->updated_at),
        ];
    }

    /**
     * @param Collection $collection
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTracks(Collection $collection)
    {
        return $this->collection($collection->tracks, new TrackTransformer);
    }

    /**
     * @param Collection $collection
     * @return Item
     */
    public function includeSaga(Collection $collection)
    {
        return $this->item($collection->saga, new SagaTransformer);
    }
}
