<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Client extends Authenticatable {
    use Notifiable;
    protected $table = 'clients';
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'image',
    ];


    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
