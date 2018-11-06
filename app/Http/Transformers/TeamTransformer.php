<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Team;

class TeamTransformer extends Transformer
{
    protected $defaultIncludes = [
        'picture',
    ];

    protected $availableIncludes = [
        'authors',
        'sagas',
    ];

    public function transform(Team $team)
    {
        return [
            'id' => $team->fakeId(),
            'slug' => $team->slug,
            'name' => $team->name,
            'bio' => $team->bio,
            'links' => [
                'netowiki' => $team->link_netowiki,
                'site' => $team->link_site,
                'facebook' => $team->link_facebook,
                'twitter' => $team->link_twitter,
            ],
            'stats' => $team->stats()->toArray(),
            'created_at' => $this->getFormatedDate($team->created_at),
            'updated_at' => $this->getFormatedDate($team->updated_at),
        ];
    }

    /**
     * @param Team $team
     * @return Item
     */
    public function includePicture(Team $team)
    {
        return $this->item(
            $team,
            new SingleImageTransformer('picture', ['main', 'thumb'])
        );
    }

    public function includeAuthors(Team $team)
    {
        return $this->collection($team->authors, new AuthorTransformer());
    }

    /**
     * @param Team $team
     * @return Collection
     */
    public function includeSagas(Team $team)
    {
        return $this->collection($team->sagas, new SagaTransformer);
    }
}
