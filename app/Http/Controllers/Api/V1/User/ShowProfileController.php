<?php

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Radiophonix\Domain\Badge\BadgeRegistry;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\Profile\ProfileTransformer;
use Radiophonix\Models\User;

class ShowProfileController extends ApiController
{
    /** @var BadgeRegistry */
    private $badgeRegistry;

    public function __construct(BadgeRegistry $badgeRegistry)
    {
        $this->badgeRegistry = $badgeRegistry;
    }

    public function __invoke(User $user)
    {
        return $this->item($user, new ProfileTransformer($this->badgeRegistry));
    }
}
