<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable, AuthenticatableTrait; 

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'profile',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
