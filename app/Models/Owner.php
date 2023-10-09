<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'contact_number'
    ];

    public function vehicles() {
        return $this->hasMany(Vehicle::class)
            ->whereNull('deleted_at');
    }
}
