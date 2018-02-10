<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Invite;

class InviteTransformer extends Transformer
{
    protected $availableIncludes = [
        'team',
        'inviting'
    ];

    public function transform(Invite $invite)
    {
        return [
            'id' => (int)$invite->id,
            'created_at' => $this->getFormatedDate($invite->created_at),
            'updated_at' => $this->getFormatedDate($invite->updated_at),
        ];
    }

    public function includeTeam(Invite $invite)
    {
        return $this->item($invite->team, new TeamTransformer);
    }

    public function includeInviting(Invite $invite)
    {
        return $this->item($invite->inviting, new UserTransformer);
    }
}
