<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaceType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'position',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function basketItems(): HasMany
    {
        return $this->hasMany(Basket::class);
    }
}
