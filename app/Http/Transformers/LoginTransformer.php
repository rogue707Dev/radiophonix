<?php

namespace Radiophonix\Http\Transformers;

use League\Fractal\Resource\Item;
use Radiophonix\Dto\LoginDto;
use Radiophonix\Http\Transformers\Support\Transformer;

class LoginTransformer extends Transformer
{
    protected $defaultIncludes = [
        'user',
        'likes',
    ];

    public function transform(LoginDto $dto): array
    {
        return [
            'access_token' => $dto->token,
            'token_type' => 'bearer',
            'expires_in' => $dto->ttl * 60,
        ];
    }

    public function includeUser(LoginDto $dto): Item
    {
        return $this->item($dto->user, new UserTransformer());
    }

    public function includeLikes(LoginDto $dto): Item
    {
        return $this->item($dto->likes, new LikesTransformer());
    }
}
