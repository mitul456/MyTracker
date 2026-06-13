<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    protected $appends = ['currency'];

    public function getCurrencyAttribute()
    {
        return $this->user?->profile?->currency;
    }
}
