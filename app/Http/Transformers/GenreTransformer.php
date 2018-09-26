<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Genre;

class GenreTransformer extends Transformer
{
    protected $availableIncludes = [
        'sagas',
    ];

    protected $defaultIncludes = [
        'image',
    ];

    /**
     * @param Genre $genre
     * @return array
     */
    public function transform(Genre $genre)
    {
        if ($genre->relationLoaded('sagas')) {
            $this->defaultIncludes[] = 'sagas';
        }

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

    /**
     * @param Genre $genre
     * @return Collection
     */
    public function includeSagas(Genre $genre)
    {
        // @todo faire ça de façon plus globale
        $sagas = $genre->sagas()->visibles()->get();

        return $this->collection($sagas, new SagaTransformer());
    }
}
