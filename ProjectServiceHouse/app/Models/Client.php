<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Client extends Authenticatable
{
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
        'password',
        'remember_token',
    ];
    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(CustomerService::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(CustomerService::class, 'receiver_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }

    public function FavoriteClient()
    {
        return $this->hasMany(Favorite::class, 'client_id');
    }
}
