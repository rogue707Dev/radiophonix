<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as IlluminateUser;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\IsSagaOwner;
use Radiophonix\Models\Support\SagaOwner;

/**
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property string $bio
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Author[] $author
 * @property-read Collection|User[] $members
 * @property-read Collection|Saga[] $sagas
 * @property-read User $owner
 */
class Team extends Model implements SagaOwner
{
    use HasFakeId;
    use IsSagaOwner;

    /**
     * @var array
     */
    protected $fillable = ['name', 'bio'];

    /**
     * @param User $user
     * @param bool|false $owner
     * @return $this
     */
    public function addMember(User $user, $owner = false)
    {
        $this->members()->save($user);

        if ($owner === true) {
            $this->owner()->associate($user);
        }

        return $this;
    }

    /**
     * Return true if the given User is in this Team
     *
     * @param User $user
     * @return bool
     */
    public function hasMember(User $user)
    {
        return collect($this->members)
            ->contains('id', '=', $user->id);
    }

    /**
     * Return true if the given User is the owner of this Team
     * @param IlluminateUser $user
     * @return bool
     */
    public function isOwner(IlluminateUser $user)
    {
        return $this->owner_id == $user->id;
    }

    /**
     * The user who's in charge of this team.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The list of users in this team.
     *
     * @return BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }
}
