<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Work extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'service_id',
        'supplier_id',
        'title',
        'description',
        'price',
        'image',
        'attachments'
        
    ];

    public function service()
    {
        return $this->belongsTo(services::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}




