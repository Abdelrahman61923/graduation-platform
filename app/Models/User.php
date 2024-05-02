<?php

namespace App\Models;

use App\Traits\HasConstants;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasConstants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'student_id', 'department_id', 'email', 'password', 'role', 'phone', 'photo', 'address', 'is_change_password', 'is_blocked', 'provider', 'provider_id', 'provider_token'
    ];

    const ROLE_ADMIN = 'admin';
    const ROLE_SUPERVISOR = 'supervisor';
    const ROLE_USER = 'student';

    /**
     * List all available roles.
     */
    public static function roles(): array
    {
        return self::getConstantsWithPrefix('ROLE_');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class, 'member_id', 'id');
    }

    public function scopeUsers($query)
    {
        return $query->where("users.role", self::ROLE_USER);
    }

    public function scopeAdmins($query)
    {
        return $query->where("users.role", self::ROLE_ADMIN);
    }

    public function scopeSupervisors($query)
    {
        return $query->where("users.role", self::ROLE_SUPERVISOR);
    }

    public function getTeamAttribute()
    {
        return $this->member?->team??null;
    }

    public function leaderTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'leader_id', 'id');
    }

    public function supervisorTeams(): HasMany
    {
        return $this->hasMany(Team::class, 'supervisor_id', 'id');
    }

    public function setProviderTokenAttribute($value)
    {
        $this->attributes['provider_token'] = Crypt::encryptString($value);
    }

    public function getProviderTokenAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
