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
        return $likes
            ->map(function (Like $like) {
                $fakeId = $this->fakeId()
                    ->connection($like->likeable_type)
                    ->encode($like->likeable_id);

                return [
                    'type' => $like->likeable_type,
                    'id' => $fakeId,
                ];
            })
            ->groupBy('type')
            ->map(function (Collection $likes) {
                return $likes->pluck('id');
            })
            ->all();
    }
}
