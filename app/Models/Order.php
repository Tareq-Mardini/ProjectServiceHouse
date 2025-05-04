<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'client_id',
        'supplier_id',
        'price',
        'order_status',
        'payment_status',
        'supplier_status',
        'order_description',
        'selected_offers'
    ];

    public function Work()
    {
        return $this->belongsTo(Work::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function files()
    {
        return $this->hasMany(OrderFile::class);
    }
}
