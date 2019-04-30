<?php
declare(strict_types=1);

namespace Radiophonix\Http\Transformers\Invite;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\SiteInvite;

class SiteInviteTransformer extends Transformer
{
    public function transform(SiteInvite $invite): array
    {
        return [
            'code' => $invite->uuid,
            'email' => $invite->email,
        ];
    }
}
