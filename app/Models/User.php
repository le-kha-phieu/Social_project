<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = "users";

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'role',
        'status',
        'avatar',
        'token_verify_email',
        'token_verify_password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

}
