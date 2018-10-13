<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Author;

class AuthorTransformer extends Transformer
{
    protected $defaultIncludes = [
        'picture',
    ];

    /**
     * Transform an Author model into an array
     *
     * @param Author $author
     * @return array
     */
    public function transform(Author $author)
    {
        if ($author->relationLoaded('sagas')) {
            $this->defaultIncludes[] = 'sagas';
        }

        return [
            'id' => $author->fakeId(),
            'slug' => $author->slug,
            'name' => $author->name,
            'bio' => $author->bio,
            'links' => [
                'netowiki' => $author->link_netowiki,
                'site' => $author->link_site,
                'topic' => $author->link_topic,
                'facebook' => $author->link_facebook,
                'twitter' => $author->link_twitter,
            ],
            'stats' => [
                'sagas' => $author->stats()->sagas(),
            ],
            'created_at' => $this->getFormatedDate($author->created_at),
            'updated_at' => $this->getFormatedDate($author->updated_at),
        ];
    }

    /**
     * @param Author $author
     * @return Item
     */
    public function includePicture(Author $author)
    {
        return $this->item(
            $author,
            new SingleImageTransformer('picture', ['main', 'thumb'])
        );
    }

    /**
     * @param Author $author
     * @return Collection
     */
    public function includeSagas(Author $author)
    {
        return $this->collection($author->sagas, new SagaTransformer);
    }
}
