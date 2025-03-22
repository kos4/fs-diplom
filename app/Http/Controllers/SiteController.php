<?php

namespace App\Http\Controllers;

use App\Dates;
use App\Models\Movie;
use App\Models\MovieSession;

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
        ]);
    }

    public function payment()
    {
        return view('site.pages.payment', [
            'pageTitle' => 'ИдёмВКино',
        ]);
    }

    public function ticket()
    {
        return view('site.pages.ticket', [
            'pageTitle' => 'ИдёмВКино',
        ]);
    }
}
