<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    protected $fillable = [
        'hall_id',
        'type_id',
        'number',
        'position',
        'row',
    ];

    public function placeType(): BelongsTo
    {
        return $this->belongsTo(PlaceType::class);
    }
}
