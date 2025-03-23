<?php

namespace App\Http\Controllers;

use App\Dates;
use App\Models\Basket;
use App\Models\Movie;
use App\Models\MovieSession;
use App\Models\Order;
use chillerlan\QRCode\QRCode;
use Illuminate\Support\Carbon;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.pages.index', [
            'pageTitle' => 'ИдёмВКино',
            'movies' => Movie::whereHas('movieSessions.hall', fn($hall) => $hall->where('is_active', true))->orderBy('position')->get(),
            'dates' => Dates::getDates(),
        ]);
    }

    public function hall(string $movieSession_id)
    {
        $movieSession = MovieSession::find($movieSession_id);

        return view('site.pages.hall', [
            'pageTitle' => 'ИдёмВКино',
            'hall' => $movieSession->hall,
            'movie' => $movieSession->movie,
            'movieSession' => $movieSession,
            'booked' => Basket::getBooked($movieSession),
        ]);
    }

    public function payment()
    {
        return view('site.pages.payment', [
            'pageTitle' => 'ИдёмВКино',
        ]);
    }

    public function ticket(string $order_id)
    {
        $order = Order::find($order_id);
        $movieSession = $order->movieSession;
        $hall = $movieSession->hall;
        $date = Carbon::parse($order->date)->isoFormat('D MMMM YYYY г.');
        $places = [];
        $placesStr = '';

        foreach ($order->basketItems as $basketItem) {
            $placesStr .= $basketItem->place_number . '(' . $basketItem->row_number . ' ряд),';
            $places[] = [
                'row' => $basketItem->row_number,
                'place' => $basketItem->place_number,
            ];
        }

        $qrCode = (new QRCode)->render("
            На фильм: {$movieSession->movie->title}
            Места: {$placesStr}
            В зале: {$hall->name}
            Начало сеанса: {$date}
        ");

        return view('site.pages.ticket', [
            'pageTitle' => 'ИдёмВКино',
            'movie' => $movieSession->movie,
            'hall' => $hall,
            'movieSession' => $movieSession,
            'places' => $places,
            'date' => $date,
            'qrCode' => $qrCode,
        ]);
    }
}
