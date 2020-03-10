<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\UuidIdTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UuidIdTrait;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string
     */
    protected $keyType = 'uuid';


    /**
     * @return BelongsTo
     */
    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role', 'type');
    }


    /**
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }


    /**
     * @return HasMany
     */
    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }


    /**
     * @return HasMany
     */
    public function journalsLastLogin(): HasMany
    {
        return $this->hasMany(Journal::class)->where('event', 'userLogin')->latest()->limit(1);
    }


    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }


    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
