<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'position',
        'rows',
        'places',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function movieSessions(): HasMany
    {
        return $this->hasMany(MovieSession::class);
    }
}
