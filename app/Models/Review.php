<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'work_id',
        'quality',
        'communication',
        'timeliness',
        'satisfaction',
        'overall',
        'comment',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function supplier()
    {
        return $this->work->supplier(); // يتم الوصول إليه عبر علاقة العمل
    }
}