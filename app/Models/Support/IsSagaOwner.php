<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Radiophonix\Models\Author;

trait IsSagaOwner
{
    public function author(): MorphOne
    {
        return $this->morphOne(Author::class, 'owner');
    }

    /**
     * This method is used to retrieve the Author instance
     *
     * @return Author
     */
    public function getAuthorModel(): Author
    {
        if (null === $this->author) {
            $this->author = new Author();
            $this->author->owner()->associate($this);
            $this->author->save();
        }

        return $this->author;
    }
}
