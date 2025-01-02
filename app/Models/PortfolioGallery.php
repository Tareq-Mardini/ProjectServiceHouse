<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'title',
        'thumbnail',
        'platform',
        'link',
    ];
    protected $table = 'portfolio_galleries';
    // تعريف العلاقة مع Portfolio
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }
}
