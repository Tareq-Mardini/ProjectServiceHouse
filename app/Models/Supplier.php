<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplier extends Authenticatable
{
    use Notifiable;
    protected $table = 'suppliers';
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'image',
        'status',
    ];


    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
