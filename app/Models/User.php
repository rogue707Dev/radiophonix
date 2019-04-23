<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Radiophonix\Models\Support\HasFakeId;
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
 * @property-read Collection|Badge[] $badges
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFakeId;

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

    public static function fromNameOrFakeId($nameOrFakeId)
    {
        if (is_numeric($nameOrFakeId)) {
            return static::fromFakeId((int)$nameOrFakeId);
        }

        return self::where('name', $nameOrFakeId)->first();
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
        return $this->belongsToMany(Badge::class, 'user_badges');
    }

    public function getAvatarAttribute()
    {
        return 'https://gravatar.com/avatar/' . md5($this->email) . '?d=robohash&s=200';
    }
}
