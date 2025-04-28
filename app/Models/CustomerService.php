<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerService extends Model
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


    public function senderClient()
    {
        return $this->belongsTo(Client::class, 'sender_id');
    }

    public function senderSupplier()
    {
        return $this->belongsTo(Supplier::class, 'sender_id');
    }

    public function senderAdmin()
    {
        return $this->belongsTo(Admin::class, 'sender_id');
    }

    public function receiverClient()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

    public function receiverSupplier()
    {
        return $this->belongsTo(Supplier::class, 'receiver_id');
    }

    public function receiverAdmin()
    {
        return $this->belongsTo(Admin::class, 'receiver_id');
    }
}
