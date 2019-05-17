<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Album;

class AlbumTransformer extends Transformer
{
    protected $availableIncludes = [
        'tracks'
    ];

    /**
     * @param Album $album
     * @return array
     */
    public function transform(Album $album)
    {
        return [
            'id' => $album->uuid(),
            'number' => $album->number,
            'name' => $album->name,
            'synopsis' => $album->synopsis,
            'type' => $album->type,
            'created_at' => $this->getFormatedDate($album->created_at),
            'updated_at' => $this->getFormatedDate($album->updated_at),
        ];
    }

    public function includeTracks(Album $album): Collection
    {
        return $this->collection($album->tracks, new TrackTransformer);
    }

    public function includeSaga(Album $album): Item
    {
        return $this->item($album->saga, new SagaTransformer);
    }
}
