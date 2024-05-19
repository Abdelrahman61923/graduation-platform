<?php

namespace App\Models;

use App\Traits\HasConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory, HasConstants;

    protected $fillable = [
        'supervisor_id', 'team_number', 'project_title', 'project_description', 'status', 'leader_id', 'book', 'presentation'
    ];

    const STATUS_APPROVED = 'approved';
    const STATUS_NOT_APPROVED = 'not approved';

    /**
     * List all available roles.
     */
    public static function statuses(): array
    {
        return self::getConstantsWithPrefix('STATUS_');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'team_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'team_tags', 'team_id', 'tag_id');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id', 'id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id');
    }

    public function getIsAllMembersAcceptedAttribute()
    {
        if ($this->members()->where('status', Member::STATUS_PENDING)->count() > 0) {
            return false;
        }
        if ($this->members()->count() < app(Setting::class)->first()?->min_team_member) {
            return false;
        }
        return true;
    }
}
