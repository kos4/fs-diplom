<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'movie_session_id',
        'date',
        'is_paid',
        'qr_code',
    ];

    public function movieSession(): BelongsTo
    {
        return $this->belongsTo(MovieSession::class);
    }

    public function basketItems(): HasMany
    {
        return $this->hasMany(Basket::class);
    }
}
