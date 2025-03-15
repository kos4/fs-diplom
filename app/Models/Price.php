<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $fillable = [
        'price',
        'hall_id',
        'type_id',
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function placeType(): BelongsTo
    {
        return $this->belongsTo(PlaceType::class);
    }
}
