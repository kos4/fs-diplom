<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'poster',
        'runtime',
        'country',
        'position',
    ];

    protected function posterUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url('posters/' . $this->poster),
        );
    }
}
