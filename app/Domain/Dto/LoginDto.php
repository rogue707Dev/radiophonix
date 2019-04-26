<?php

namespace Radiophonix\Domain\Dto;

use Illuminate\Support\Collection;
use Radiophonix\Models\Like;
use Radiophonix\Models\User;

class LoginDto
{
    /** @var string */
    public $token;

    /** @var int */
    public $ttl;

    /** @var User */
    public $user;

    /** @var Collection|Like[] */
    public $likes;

    /**
     * @param string $token
     * @param int $ttl
     * @param User $user
     * @param Collection|Like[] $likes
     */
    public function __construct(string $token, int $ttl, User $user, Collection $likes)
    {
        $this->token = $token;
        $this->ttl = $ttl;
        $this->user = $user;
        $this->likes = $likes;
    }
}
