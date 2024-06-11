<?php

namespace App\Models;

use App\Traits\HasConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory, HasConstants;

    protected $fillable = [
        'instruction', 'type'
    ];

    const TYPE_CREATE_NEW_TEAM = 'create new team';
    const TYPE_PROJECT1 = 'project1';
    const TYPE_PROJECT2 = 'project2';

    public static function types(): array
    {
        return self::getConstantsWithPrefix('TYPE_');
    }

    public function scopeTeam($query)
    {
        return $query->where("instructions.type", self::TYPE_CREATE_NEW_TEAM);
    }
    public function scopeProject1($query)
    {
        return $query->where("instructions.type", self::TYPE_PROJECT1);
    }
    public function scopeProject2($query)
    {
        return $query->where("instructions.type", self::TYPE_PROJECT2);
    }
}
