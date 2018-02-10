<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\IsSagaOwner;
use Radiophonix\Models\Support\SagaOwner;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $bio
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Author[] $author
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 */
class User extends Authenticatable implements SagaOwner, JWTSubject
{
    use Notifiable;
    use HasFakeId;
    use IsSagaOwner;

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
        return [
            'user' => [
                'id' => $this->id,
             ],
        ];
    }
}
