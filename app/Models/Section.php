<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    protected $dates = ['deleted_at'];


    public function services()
    {
        return $this->hasMany(services::class, 'section_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($section) {
            $section->services()->each(function ($services) {
                $services->delete();
            });
        });
    }
}