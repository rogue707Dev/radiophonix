<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Author;
use Radiophonix\Models\User;

class ProfileTransformer extends Transformer
{
    protected $availableIncludes = ['author'];

    public function transform(User $user): array
    {
        $includes = [];

        if ($user->author instanceof Author) {
            $includes = ['author'];
        }

        $this->setDefaultIncludes($includes);

        return [
            'id' => $user->fakeId(),
            'name' => $user->name,
            'avatar' => $user->avatar,
            'created_at' => $this->getFormatedDate($user->created_at),
            'updated_at' => $this->getFormatedDate($user->updated_at),
        ];
    }

    public function includeAuthor(User $user): Item
    {
        return $this->item($user->author, new AuthorTransformer());
    }
}
