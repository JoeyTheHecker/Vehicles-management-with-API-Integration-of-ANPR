<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'owner_id',
        'brand_id',
        'model',
        'serial_number',
        'plate_number',
        'slug_plate_number'
    ];

    public function setSlugPlateNumberAttribute($value) {
        $value = str_replace(" ", "", $value);
        $value = strtolower($value);
        $this->attributes['slug_plate_number'] = $value;
    }

    public function owner() {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function images() {
        return $this->hasMany(VehicleImage::class, 'vehicle_id');
    }
}
