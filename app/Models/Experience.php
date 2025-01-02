<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'date',
        'description',
    ];

    // تعريف العلاقة مع Portfolio
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }
}
