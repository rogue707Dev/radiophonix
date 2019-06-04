<?php

namespace Radiophonix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Représente une invitation sur le site (lors de l'inscription).
 *
 * @property int $id
 * @property string $uuid
 * @property string $email
 * @property string $type
 * @property Carbon $used_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SiteInvite extends Model
{
    public const TYPE_MP3_AT_PARIS_2019 = 'mp3-at-paris-2019';

    public function markAsUsed(): void
    {
        $this->used_at = Carbon::now();
        $this->save();
    }
}
