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

    public function hall(MovieSession $movieSession)
    {
        return view('site.pages.hall', []);
    }
}
