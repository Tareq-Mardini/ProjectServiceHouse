<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class services extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'section_id',
        'name',
        'description',
        'image'
    ];

    protected $dates = ['deleted_at'];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}