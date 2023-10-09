<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'image_path' => asset('uploads/images/plate-number/' . $this->image_path),
            'result_plate_number' => strtoupper($this->result_plate_number),
            'is_success' => $this->is_success,
            'created_at' => $this->created_at->format("m/d/Y h:i A")
        ];
    }
}
