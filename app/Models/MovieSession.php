<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class MovieSession extends Model
{
    protected $fillable = [
        'hall_id',
        'movie_id',
        'movie_session_time',
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                $startTime = Carbon::parse($this->movie_session_time);

                return ($startTime->hour * 60) + $startTime->minute;
            }
        );
    }
}
