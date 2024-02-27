<?php

namespace App\Models;

use App\Traits\HasConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, HasConstants;

    protected $fillable = [
        'name', 'status'
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * List all available statuses.
     */
    public static function statuses(): array
    {
        return self::getConstantsWithPrefix('STATUS_');
    }

    public function scopeActive($query)
    {
        return $query->where("tags.status", self::STATUS_ACTIVE);
    }

    public function scopeInActive($query)
    {
        return $query->where("tags.status", self::STATUS_INACTIVE);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_tags', 'tag_id', 'team_id');
    }
}
