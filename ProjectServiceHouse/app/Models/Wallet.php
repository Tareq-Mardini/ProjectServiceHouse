<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'balance',
        'wallet_password',
    ];

    protected static function booted()
    {
        static::creating(function ($wallet) {
            $wallet->wallet_number = self::generateWalletNumber();
        });
    }

    public static function generateWalletNumber()
    {
        do {
            $randomLetters = strtoupper(Str::random(4));
            $randomNumbers = mt_rand(1000, 9999);
            $walletNumber = "SH-{$randomLetters}-{$randomNumbers}";
        } while (self::where('wallet_number', $walletNumber)->exists());

        return $walletNumber;
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'user_id');
    }
}
