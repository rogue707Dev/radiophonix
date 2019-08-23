<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Image\MultipleImagesTransformer;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Saga;

class SagaTransformer extends Transformer
{
    protected $availableIncludes = [
        'genres',
        'albums',
        'team',
        'authors',
    ];

    protected $defaultIncludes = [
        'images',
    ];

    /**
     * @param Saga $saga
     * @return array
     */
    public function transform(Saga $saga)
    {
        return [
            'id' => $saga->uuid(),
            'slug' => $saga->slug,
            'name' => $saga->name,
            'synopsis' => $saga->synopsis,
            'creation_date' => $this->getFormatedDate($saga->creation_date, 'Y-m-d'),
            'licence' => $saga->getLicence()->toArray(),
            'links' => [
                'netowiki' => $saga->link_netowiki,
                'site' => $saga->link_site,
                'facebook' => $saga->link_facebook,
                'twitter' => $saga->link_twitter,
            ],
            'rss' => $this->rss($saga),
            'finished' => $saga->finished,
            'stats' => $saga->stats()->toArray(),
            'created_at' => $this->getFormatedDate($saga->created_at),
            'updated_at' => $this->getFormatedDate($saga->updated_at),
        ];
    }

    private function rss(Saga $saga): array
    {
        return [
            'url' => $saga->getRssLink(),
            'is_custom' => $saga->hasCustomRssLink(),
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

    public function includeAlbums(Saga $saga): Collection
    {
        $requestedIncludes = $this->getCurrentScope()
            ->getManager()
            ->getRequestedIncludes();

        if (in_array('albums.tracks', $requestedIncludes)) {
            $saga->load('albums.tracks');
        } else {
            $saga->load('albums');
        }

        return $this->collection($saga->albums, new AlbumTransformer);
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
