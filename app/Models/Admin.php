<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'ph_number',
        'image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sentMessages()
    {
        return $this->hasMany(CustomerService::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(CustomerService::class, 'receiver_id');
    }
}


