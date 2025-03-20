<?php

namespace App\Http\Controllers;

use App\Dates;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function dates(Request $request) {
        $action = $request->input('action');
        $lastDate = $request->input('lastDate');

        return response()->json([
            'success' => true,
            'list' => view('site.includes.index.indexDates', ['dates' => Dates::getDates($action, $lastDate)])->render(),
        ]);
    }

    public function setChosenDate(Request $request) {
        $date = Carbon::parse($request->input('date'));
        $request->session()->put('selectedDate', $date->toDateString());

        return response()->json([
            'success' => true,
        ]);
    }
}
