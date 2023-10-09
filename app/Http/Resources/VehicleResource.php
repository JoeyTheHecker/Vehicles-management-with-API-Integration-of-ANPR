<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'owner_name' => $this->owner->first_name . ' ' . $this->owner->last_name,
            'brand_id' => $this->brand->id,
            'brand_name' => $this->brand->name,
            'model' => $this->model,
            'serial_number' => $this->serial_number,
            'plate_number' => $this->plate_number,
            'images' => VehicleImage::collection($this->images),
            'created_at' => $this->created_at->format("m/d/Y h:i A"),
            'updated_at' => $this->updated_at->format("m/d/Y h:i A")
        ];
    }
}
