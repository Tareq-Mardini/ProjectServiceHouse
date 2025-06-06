<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'about_me',
        'language',
    ];

    // تعريف العلاقة مع Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function skills()
{
    return $this->hasMany(Skill::class, 'portfolio_id');
}
public function experiences()
{
    return $this->hasMany(Experience::class, 'portfolio_id');
}
public function educations()
{
    return $this->hasMany(Education::class, 'portfolio_id');
}
public function galleries()
{
    return $this->hasMany(PortfolioGallery::class, 'portfolio_id');
}
}