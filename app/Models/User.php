<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Radiophonix\Models\Support\GeneratesUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $avatar
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Author $author
 * @property-read Album|Badge[] $badges
 */
class User extends Authenticatable implements JWTSubject
{
    use GeneratesUuid;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function fromNameOrUuid($nameOrUuid)
    {
        return self::where('name', $nameOrUuid)
            ->orWhere('uuid', $nameOrUuid)
            ->first();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return HasOne
     */
    public function author()
    {
        return $this->hasOne(Author::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')->withTimestamps();
    }

    public function getAvatarAttribute()
    {
        return 'https://gravatar.com/avatar/' . md5($this->email) . '?d=robohash&s=200';
    }
}
