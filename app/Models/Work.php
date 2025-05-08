<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'supplier_id',
        'title',
        'description',
        'price',
        'thumbnail',
        'youtube_link',
        'Average_delivery_time',
        'Average_speed_of_response'
    ];

    protected $dates = ['deleted_at'];

    public function service()
    {
        return $this->belongsTo(services::class, 'service_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(WorkImage::class, 'work_id', 'id'); // علاقة `hasMany` تربط العمل بالصور المتعددة.
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function extras()
    {
        return $this->hasMany(WorkExtra::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function FavoritedWork()
    {
        return $this->hasMany(Favorite::class,'work_id');
    }
}
