<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class WorkExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'title',
        'price',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
