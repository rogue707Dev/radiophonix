<?php

namespace Radiophonix\Models\Support;

/**
 * This interface allows type hinting of classes using the HasMediaTrait
 * from Laravel Media Library because it's impossible to type hint a trait.
 * It's used in the ImageTransformer class.
 *
 * @see \Spatie\MediaLibrary\HasMedia\HasMediaTrait
 * @see \Radiophonix\Http\Transformers\SingleImageTransformer
 */
interface HasMedia
{
    /**
     * @param string $collectionName
     * @param string $conversionName
     * @return string
     */
    public function getFirstMediaUrl(string $collectionName = 'default', string $conversionName = ''): string;
}
