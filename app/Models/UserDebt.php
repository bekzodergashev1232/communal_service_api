<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDebt extends Model
{
    protected $fillable = [
        'user_id',
        'is_debt',
        'debt_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
