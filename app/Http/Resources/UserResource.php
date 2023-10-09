<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'profile_photo_path' => $this->profile_photo_path,
            'role_id' => $this->role->id,
            'role_name' => $this->role->name,
            'created_at' => $this->created_at->format("m/d/Y h:i A"),
            'updated_at' => $this->updated_at->format("m/d/Y h:i A")
        ];
    }
}
