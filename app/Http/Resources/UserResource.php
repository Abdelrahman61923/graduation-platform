<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'student_id' => $this->student_id,
            'department' => $this->department ? $this->department->name : null,
            'email' => $this->email,
            'role' => $this->role,
            'is_change_password' => $this->is_change_password,
            'phone' => $this->phone,
            'photo' => $this->photo,
            'address' => $this->address,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
        ];
    }
}
