<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'role',
        'seen',
        'image'
    ];
    public function sender()
    {
        return $this->belongsTo(Client::class, 'sender_id');
    }

    
    public function receiver()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

    public function receiverProfilee()
    {
        return $this->belongsTo(Supplier::class, 'receiver_id', 'id')->select(['id', 'name', 'picture']);
    }

    public function senderProfilee()
    {
        return $this->belongsTo(Supplier::class, 'sender_id', 'id')->select(['id', 'name', 'picture']);
    }
     
    public function receiverSellerProfile()
    {
        return $this->belongsTo(Client::class, 'receiver_id', 'id')->select(['id', 'name', 'picture']);
    }

    public function senderSellerProfile()
    {
        return $this->belongsTo(Client::class, 'sender_id', 'id')->select(['id', 'name', 'picture']);
    }
}
