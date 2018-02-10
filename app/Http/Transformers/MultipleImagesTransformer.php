<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Support\HasMedia;

/**
 * This transformer will return an array of images transformed using the
 * SingleImageTransformer class
 *
 * @see SingleImageTransformer
 */
class MultipleImagesTransformer extends Transformer
{
    /**
     * @var array
     */
    private $images = [];

    /**
     * @param array $images
     *
     * The $images parameter needs to be like this:
     *
     * [
     *     'mediaCollection' => ['size1', 'size2'],
     * ]
     */
    public function __construct(array $images = [])
    {
        $this->images = $images;
    }

    /**
     * @param HasMedia $modelWithMedia
     * @return array
     */
    public function transform(HasMedia $modelWithMedia)
    {
        $images = [];

        foreach ($this->images as $mediaCollection => $sizes) {
            $transformer = new SingleImageTransformer($mediaCollection, $sizes);

            $images[$mediaCollection] = $transformer->transform($modelWithMedia);
        }

        return $images;
    }
}
