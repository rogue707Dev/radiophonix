<?php

namespace Radiophonix\Http\Transformers\Image;

use Radiophonix\Http\Transformers\Support\Transformer;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

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

    public function transform(HasMedia $modelWithMedia): array
    {
        $image = [];

        /** @var HasMediaTrait $model */
        $model = $modelWithMedia;

        foreach ($this->sizes as $size) {
            $image[$size] = $model->getFirstMediaUrl($this->mediaCollection, $size);
        }

        $media = $model->getFirstMedia($this->mediaCollection);

        if (null === $media) {
            return $image;
        }

        if ($media->hasCustomProperty('color')
            && $media->hasCustomProperty('color')
        ) {
            $image['meta'] = [
                'color' => $media->getCustomProperty('color'),
                'type' => $media->getCustomProperty('color_type'),
            ];
        }

        return $image;
    }
}
