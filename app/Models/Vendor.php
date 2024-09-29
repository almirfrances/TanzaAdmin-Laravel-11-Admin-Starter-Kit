<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\SendsVerificationCode;


class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, SendsVerificationCode;

    protected $fillable = [
        'vendor_name',
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
