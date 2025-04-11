<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'user_id', 
        'current_balance', 
        'monthly_interest', 
        'target_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
