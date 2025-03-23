<?php

namespace App;

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

class Dates
{
    public static function getDates($action = null, $lastDate = null): array
    {
        $currentDate = CarbonImmutable::parse(Carbon::now()->toDateString())->locale('ru_RU');
        $mutable = $currentDate;
        $flag = false;
        $ct = 5;
        if (request()->session()->get('selectedDate')) {
            $selectedDate = CarbonImmutable::parse(request()->session()->get('selectedDate'))->locale('ru_RU');

            if ($selectedDate > $currentDate->addDays($ct)) {
                $ct = 6;
            }
        } else {
            $selectedDate = null;
        }

        if ($action) {
            $mutable = CarbonImmutable::parse($lastDate)->addDays($action === 'next' ? 1 : -1)->locale('ru_RU');

            if ($mutable->addDays(-5) > $currentDate) {
                $flag = true;
            } else {
                $mutable = $currentDate;
            }
        }

        if ($flag) {
            if ($action === 'prev') {
                $mutable = $mutable->addDays(-$ct);
            }
        }

        $dates[0] = [
            'date' => $mutable,
            'chosen' => !$selectedDate || ($selectedDate == $currentDate && $currentDate == $mutable),
            'today' => $currentDate == $mutable,
        ];
        for ($i = 1; $i <= $ct; $i++) {
            $createDay = $mutable->addDays($i);
            $dates[$i] = [
                'date' => $createDay,
                'today' => false,
                'chosen' => false,
            ];
            ;
            if ($createDay == $selectedDate) {
                $dates[$i]['chosen'] = true;
                $dates[0]['chosen'] = false;
            }
        }

        return $dates;
    }

    public static function getSelectedDate(): Carbon
    {
        $request = request();

        if ($request->session()->has('selectedDate')) {
            $date = Carbon::parse($request->session()->get('selectedDate'))->locale('ru_RU');
        } else {
            $date = Carbon::now()->locale('ru_RU');
        }

        return $date;
    }
}
