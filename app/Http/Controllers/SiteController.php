<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSession;
use Carbon\CarbonImmutable;

class SiteController extends Controller
{
    public function index()
    {
        $currentDate = CarbonImmutable::now()->locale('ru_RU');
        $mutable = $currentDate;
        $selectedDate = null;
        $ct = 5;

        if (request()->session()->get('selectedDate')) {
            $selectedDate = CarbonImmutable::parse(request()->session()->get('selectedDate'));

            if ($currentDate->addDays($ct) < $selectedDate) {
                $mutable = $selectedDate;
                $ct = 4;
            }
        }

        $dates[0] = [
            'date' => $mutable,
            'chosen' => true,
            'today' => $currentDate === $mutable,
        ];
        for ($i = 1; $i <= $ct; $i++) {
            $createDay = $mutable->addDays($i);
            $dates[$i] = [
                'date' => $createDay,
                'today' => false,
                'chosen' => false,
            ];

            if ($createDay === $selectedDate) {
                $dates[$i]['chosen'] = true;
                $dates[0]['chosen'] = false;
            }
        }

        return view('site.pages.index', [
            'pageTitle' => 'ИдёмВКино',
            'movies' => Movie::whereHas('movieSessions.hall', fn($hall) => $hall->where('is_active', true))->orderBy('position')->get(),
            'dates' => $dates,
            'selectedDate' => $selectedDate,
        ]);
    }

    public function dates() {
        return view('site.includes.indexDates', []);
    }

    public function hall(MovieSession $movieSession)
    {
        return view('site.pages.hall', []);
    }
}
