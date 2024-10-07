<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens; // Include this line to enable token management

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