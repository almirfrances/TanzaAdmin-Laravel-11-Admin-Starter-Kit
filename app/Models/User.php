<?php

namespace App\Models;

use App\Traits\SendsVerificationCode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SendsVerificationCode;

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'phone',
        'password',
        'profile_image',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'verification_code',
        'is_verified',
        'status',
        'university_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}