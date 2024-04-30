<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'member' => [
                'id' => $this->user->id,
                'full_name' => $this->user->full_name,
                'student_id' => $this->user->student_id,
                'phone' => $this->user->phone,
                'department' => $this->user->department ? $this->user->department->name : null,
            ],
            'team_id' => $this->team_id,
            'status' => $this->status,
            'is_leader' => $this->is_leader,
        ];
    }
}
