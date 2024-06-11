<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'team_number' => $this->team_number,
            'supervisor' => $this->supervisor ? [
                'id' => $this->supervisor->id,
                'first_name' => $this->supervisor->first_name,
                'last_name' => $this->supervisor->last_name,
                'full_name' => $this->supervisor->full_name,
                'email' => $this->supervisor->email,
                'phone' => $this->supervisor->phone,
            ] : null,
            'leader' => $this->leader ? [
                'id' => $this->leader->id,
                'photo' => $this->leader->photo,
                'full_name' => $this->leader->full_name,
                'student_id' => $this->leader->student_id,
            ] : null,

            'project_title' => $this->project_title,
            'project_description' => $this->project_description,
            'status' => $this->status,
            'book' => $this->book,
            'presentation' => $this->presentation,
        ];
    }
}
