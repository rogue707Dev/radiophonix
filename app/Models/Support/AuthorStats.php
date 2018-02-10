<?php

namespace Radiophonix\Models\Support;

use Radiophonix\Models\Author;

class AuthorStats
{
    /**
     * @var Author
     */
    private $author;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function sagas(): int
    {
        return (int)$this->author->sagas()->count();
    }
}
