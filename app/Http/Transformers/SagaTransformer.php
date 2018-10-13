<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Saga;

class SagaTransformer extends Transformer
{
    protected $availableIncludes = [
        'genres',
        'collections',
        'team',
    ];

    protected $defaultIncludes = [
        'authors',
        'images',
    ];

    /**
     * @param Saga $saga
     * @return array
     */
    public function transform(Saga $saga)
    {
        if ($saga->relationLoaded('genres')) {
            $this->defaultIncludes[] = 'genres';
        }

        return [
            'id' => $saga->fakeId(),
            'slug' => $saga->slug,
            'name' => $saga->name,
            'synopsis' => $saga->synopsis,
            'creation_date' => $this->getFormatedDate($saga->creation_date),
            'licence' => $saga->licence,
            'links' => [
                'netowiki' => $saga->link_netowiki,
                'site' => $saga->link_site,
                'topic' => $saga->link_topic,
                'rss' => $saga->link_rss,
                'facebook' => $saga->link_facebook,
                'twitter' => $saga->link_twitter,
            ],
            'finished' => $saga->finished,
            'visibility' => (int)$saga->visibility,
            'stats' => $saga->stats()->toArray(),
            'created_at' => $this->getFormatedDate($saga->created_at),
            'updated_at' => $this->getFormatedDate($saga->updated_at),
        ];
    }

    /**
     * @param Saga $saga
     * @return Collection
     */
    public function includeAuthors(Saga $saga)
    {
        return $this->collection($saga->authors, new AuthorTransformer);
    }

    public function includeTeam(Saga $saga)
    {
        if ($saga->team === null) {
            return null;
        }

        return $this->item($saga->team, new TeamTransformer());
    }

    /**
     * @param Saga $saga
     * @return Collection
     */
    public function includeGenres(Saga $saga)
    {
        return $this->collection($saga->genres, new GenreTransformer);
    }

    /**
     * @param Saga $saga
     * @return Collection
     */
    public function includeCollections(Saga $saga)
    {
        $requestedIncludes = $this->getCurrentScope()
            ->getManager()
            ->getRequestedIncludes();

        if (in_array('collections.tracks', $requestedIncludes)) {
            $saga->load('collections.tracks');
        } else {
            $saga->load('collections');
        }

        return $this->collection($saga->collections, new CollectionTransformer);
    }

    /**
     * @param Saga $saga
     * @return Item
     */
    public function includeImages(Saga $saga)
    {
        $images = collect(
            [
                'cover' => ['main', 'thumb'],
            ]
        )
            ->filter(function ($sizes, $collectionName) use ($saga) {
                return $saga->hasMedia($collectionName);
            })
            ->all();

        return $this->item($saga, new MultipleImagesTransformer($images));
    }
}
