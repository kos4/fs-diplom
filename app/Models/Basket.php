<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Basket extends Model
{
    protected $fillable = [
        'order_id',
        'place_number',
        'place_type_id',
        'price',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function placeType(): BelongsTo
    {
        return $this->belongsTo(PlaceType::class);
    }
}
