<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{

    use HasFactory;

    protected $fillable = [
        'order_id',
        'sender_id',
        'receiver_id',
        'receiver_role',
        'status',
        'amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function senderClient()
    {
        return $this->belongsTo(Client::class, 'sender_id');
    }

    public function receiverClient()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

    public function receiverSupplier()
    {
        return $this->belongsTo(Supplier::class, 'receiver_id');
    }




    public function getSenderName()
    {
        if ($this->receiver_role === 'system') {
            return optional(Client::find($this->sender_id))->name;
        }

        if ($this->receiver_role === 'client') {
            return 'System';
        }

        if ($this->receiver_role === 'supplier') {
            return 'System';
        }

        return 'System';
    }

    public function getReceiverName()
    {
        if ($this->receiver_role === 'system') {
            return 'System';
        }

        if ($this->receiver_role === 'client') {
            return optional(Client::find($this->receiver_id))->name;
        }

        if ($this->receiver_role === 'supplier') {
            return optional(Supplier::find($this->receiver_id))->name;
        }

        return 'System';
    }
}
