<?php

namespace Radiophonix\Models\Support\Stats;

use Illuminate\Contracts\Support\Arrayable;
use Radiophonix\Models\Author;

class AuthorStats implements Arrayable
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
        return (int)$this->author->cached_sagas_count;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'sagas' => $this->sagas(),
        ];
    }
}
