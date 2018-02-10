<?php

namespace Radiophonix\Events\Author;

use Illuminate\Queue\SerializesModels;
use Radiophonix\Models\Author;

class AuthorSavingEvent
{
    use SerializesModels;

    /**
     * @var Author
     */
    public $author;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }
}
