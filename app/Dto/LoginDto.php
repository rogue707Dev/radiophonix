<?php

namespace Radiophonix\Dto;

use Radiophonix\Models\User;

class LoginDto
{
    /** @var string */
    public $token;

    /** @var int */
    public $ttl;

    /** @var User */
    public $user;

    /**
     * @param string $token
     * @param int $ttl
     * @param User $user
     */
    public function __construct(string $token, int $ttl, User $user)
    {
        $this->token = $token;
        $this->ttl = $ttl;
        $this->user = $user;
    }
}
