<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthdate',
        'address',
        'phone',
        'annual_income',
        'preferred_location',
        'radius',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}