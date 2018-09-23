<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Genre;

class GenreTransformer extends Transformer
{
    protected $defaultIncludes = [
        'image',
    ];

    /**
     * @param Genre $genre
     * @return array
     */
    public function transform(Genre $genre)
    {
        return [
            'id' => $genre->fakeId(),
            'name' => $genre->name,
            'stats' => $genre->stats()->toArray(),
        ];
    }

    /**
     * @param Genre $genre
     * @return Item
     */
    public function includeImage(Genre $genre)
    {
        return $this->item(
            $genre,
            new SingleImageTransformer('image', ['main'])
        );
    }
}
