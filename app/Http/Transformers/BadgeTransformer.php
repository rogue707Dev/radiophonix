<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Badge;

class BadgeTransformer extends Transformer
{
    public function transform(Badge $badge): array
    {
        return [
            'key' => $badge->key,
            'title' => $badge->title,
            'description' => $badge->description,
        ];
    }
}
