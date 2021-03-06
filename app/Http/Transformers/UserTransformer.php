<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\User;

class UserTransformer extends Transformer
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->uuid(),
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'created_at' => $this->getFormatedDate($user->created_at),
            'updated_at' => $this->getFormatedDate($user->updated_at),
        ];
    }
}
