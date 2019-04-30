<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Invite\Site;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\Invite\SiteInviteTransformer;
use Radiophonix\Models\SiteInvite;

class GetSiteInviteController extends ApiController
{
    public function __invoke($code)
    {
        /** @var SiteInvite $invite */
        $invite = SiteInvite::query()
            ->where('uuid', $code)
            ->whereNull('used_at')
            ->firstOrFail();

        return $this->item($invite, new SiteInviteTransformer());
    }
}
