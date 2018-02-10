<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Radiophonix\Models\Author;

/**
 * This interface is used to mark an Entity as a possible owner of a Saga
 */
interface SagaOwner
{
    /**
     * This method is used to mark the relationship
     *
     * @return MorphOne
     */
    public function author(): MorphOne;

    /**
     * This method is used to retrieve the Author instance
     *
     * @return Author
     */
    public function getAuthorModel(): Author;
}
