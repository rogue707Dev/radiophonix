<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Track;

class TrackTransformer extends Transformer
{
    public function transform(Track $track): array
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
            'created_at' => $this->getFormatedDate($track->created_at),
            'updated_at' => $this->getFormatedDate($track->updated_at),
        ];
    }

    public function includeAlbum(Track $track): Item
    {
        return $this->item($track->album, (new AlbumTransformer)->setDefaultIncludes(['saga']));
    }
}
