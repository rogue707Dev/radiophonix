<?php

namespace Radiophonix\Http\Transformers;

use Illuminate\Support\Collection;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Like;

class LikesTransformer extends Transformer
{
    /**
     * @param Collection|Like[] $likes
     * @return array
     */
    public function transform(Collection $likes): array
    {
        return Collection::wrap($likes)
            ->map(function (Like $like) {
                return [
                    'type' => $like->likeable_type,
                    'id' => $like->likeable_uuid,
                ];
            })
            ->groupBy('type')
            ->map(function (Collection $likes) {
                return $likes->sortBy('id')->pluck('id')->all();
            })
            ->union(['saga' => []])
            ->all();
    }
}
