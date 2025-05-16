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
        'password',
        'remember_token',
    ];
    public function portfolio()
    {
        return $this->hasOne(Portfolio::class, 'supplier_id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'supplier_id', 'id');
    }
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

    public function ordersReceived()
    {
        return $this->hasMany(Order::class, 'supplier_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Work::class);
    }
}
