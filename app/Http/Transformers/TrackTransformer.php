<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Track;

class TrackTransformer extends Transformer
{
    /**
     * @param Track $track
     * @return array
     */
    public function transform(Track $track)
    {
        return [
            'id' => $track->fakeId(),
            'number' => $track->number,
            'title' => empty($track->title) ? '[Titre inconnu]' : $track->title,
            'synopsis' => $track->synopsis,
            'published_at' => $this->getFormatedDate($track->published_at),
            'status' => (int)$track->status ?? Track::STATUS_DRAFT,
            'seconds' => (int)$track->length ?? 0,
            'file' => $track->url,
            'chapters' => $track->chapters ?? [],
            'created_at' => $this->getFormatedDate($track->created_at),
            'updated_at' => $this->getFormatedDate($track->updated_at),
        ];
    }

    /**
     * @param Track $track
     * @return Item
     */
    public function includeCollection(Track $track)
    {
        return $this->item($track->collection, (new CollectionTransformer)->setDefaultIncludes(['saga']));
    }
}
