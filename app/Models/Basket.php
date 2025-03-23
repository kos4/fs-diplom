<?php

namespace App\Models;

use App\Dates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Basket extends Model
{
    protected $fillable = [
        'order_id',
        'row_number',
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

    public static function getBooked(MovieSession $movieSession)
    {
        $date = Dates::getSelectedDate();
        $orders = Order::where('date', $date->toDateString())->where('movie_session_id', $movieSession->id)->get();

        if (!$orders->count()) {
            return null;
        }

        return self::whereBelongsTo($orders)->get();
    }
}
