<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function movieSessions(): HasMany
    {
        return $this->hasMany(MovieSession::class);
    }

    public function gatHalls() {
        return Hall::whereIn('id', $this->movieSessions()->groupBy('hall_id')->pluck('hall_id')->toArray())->where('is_active', true)->get();
    }

    public function getMovieSessions($hallId)
    {
        return $this->movieSessions()->where('hall_id', $hallId)->get();
    }
}
