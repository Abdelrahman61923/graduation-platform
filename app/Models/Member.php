<?php

namespace App\Models;

use App\Traits\HasConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory, HasConstants;

    const STATUS_ACCEPTED = 'accepted';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'member_id', 'team_id', 'status', 'is_leader'
    ];

    /**
     * List all available statuses.
     */
    public static function statuses(): array
    {
        return self::getConstantsWithPrefix('STATUS_');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
