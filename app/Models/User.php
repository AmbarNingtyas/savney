<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function autoCuts()
    {
        return $this->hasMany(AutoCut::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
    
}
