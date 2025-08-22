<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssiqSuv extends Model
{
    protected $fillable = [
        'user_id',
        'is_counter',
        'water_counter',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_counter' => 'boolean',
        'water_counter' => 'float',
        'price' => 'float',
    ];

}
