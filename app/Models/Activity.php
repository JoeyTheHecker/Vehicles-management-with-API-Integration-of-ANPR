<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_path',
        'result_plate_number',
        'is_success'
    ];

    protected $casts = ['is_success' => 'boolean'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
