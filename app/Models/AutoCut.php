<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoCut extends Model
{
    protected $fillable = [
        'user_id', 
        'amount', 
        'description', 
        'category', 
        'deduction_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
