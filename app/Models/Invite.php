<?php

namespace Radiophonix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as IlluminateUser;

/**
 * @property int $id
 * @property int $invited_id
 * @property int $inviting_id
 * @property int $team_id
 * @property bool $accepted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read User $invited
 * @property-read User $inviting
 * @property-read Team $team
 */
class Invite extends Model
{
    /**
     * @param IlluminateUser $user
     * @return mixed
     */
    public static function toUser(IlluminateUser $user)
    {
        return self::where('invited_id', $user->id)->get();
    }

    /**
     * @param Team $team
     * @return mixed
     */
    public static function fromTeam(Team $team)
    {
        return self::where('team_id', $team->id)->get();
    }

    /**
     * The team in which the user is invited.
     *
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * The user who's invited to the team.
     *
     * @return BelongsTo
     */
    public function invited()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The user who sent the invite.
     *
     * @return BelongsTo
     */
    public function inviting()
    {
        return $this->belongsTo(User::class);
    }
}
