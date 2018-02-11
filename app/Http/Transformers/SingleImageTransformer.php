<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Support\HasMedia;
use Radiophonix\Models\Support\HasMediaMetadata;

/**
 * This transformer is used to transform a Media.
 * It will return an associative array using the desired sizes as keys.
 */
class SingleImageTransformer extends Transformer
{
    /**
     * @var string
     */
    private $mediaCollection;

    /**
     * @var array
     */
    private $sizes = [];

    /**
     * @param string $mediaCollection The media collection to transform
     * @param array $sizes The different sizes (The original size is always included)
     */
    public function __construct(string $mediaCollection, array $sizes = [])
    {
        $this->mediaCollection = $mediaCollection;
        $this->sizes = $sizes;
    }

    /**
     * @param HasMedia $modelWithMedia
     * @return array
     */
    public function transform(HasMedia $modelWithMedia)
    {
        $image = [];

        foreach ($this->sizes as $size) {
            $image[$size] = $modelWithMedia->getFirstMediaUrl($this->mediaCollection, $size);
        }

        if ($modelWithMedia instanceof HasMediaMetadata) {
            $image['meta'] = [
                'color' => $modelWithMedia->getFirstMedia('cover')->getCustomProperty('color'),
                'type' => $modelWithMedia->getFirstMedia('cover')->getCustomProperty('color_type'),
            ];
        }

        return $image;
    }
}
