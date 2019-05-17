<?php

namespace Radiophonix\Http\Transformers\Profile;

use League\Fractal\Resource\Item;
use Radiophonix\Domain\Badge\BadgeRegistry;
use Radiophonix\Domain\Badge\BadgeType;
use Radiophonix\Http\Transformers\AuthorTransformer;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Author;
use Radiophonix\Models\User;

class ProfileTransformer extends Transformer
{
    protected $availableIncludes = [
        'author',
    ];

    /** @var BadgeRegistry */
    private $badgeRegistry;

    public function __construct(BadgeRegistry $badgeRegistry)
    {
        $this->badgeRegistry = $badgeRegistry;
    }

    public function transform(User $user): array
    {
        $includes = [];

        if ($user->author instanceof Author) {
            $includes[] = 'author';
        }

        $this->setDefaultIncludes($includes);

        $ownedBadges = $user->badges->pluck('key');

        $badges = $this->badgeRegistry
            ->all()
            ->map(function (BadgeType $type) use ($ownedBadges) {
                $isOwned = $ownedBadges->contains($type->key());

                return [
                    'key' => $type->key(),
                    'title' => $type->title(),
                    'description' => $isOwned ? $type->description() : '???',
                    'isOwned' => $isOwned,
                ];
            })
            ->values()
            ->all();

        return [
            'id' => $user->uuid(),
            'name' => $user->name,
            'avatar' => $user->avatar,
            'created_at' => $this->getFormatedDate($user->created_at),
            'updated_at' => $this->getFormatedDate($user->updated_at),
            'badges' => $badges,
        ];
    }

    public function includeAuthor(User $user): Item
    {
        return $this->item($user->author, new AuthorTransformer());
    }
}
