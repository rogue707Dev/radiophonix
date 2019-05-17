<?php

namespace Radiophonix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Album|User[] $users
 */
class Badge extends Model
{
    public function awardTo(User $user): void
    {
        $this->users()->attach($user);

        $this->save();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges');
    }
}
