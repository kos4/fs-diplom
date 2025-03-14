<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\PlaceType;

class AdminController extends Controller
{
    public function index() {
        return view('admin.pages.index', [
            'pageTitle' => config('APP_NAME'),
            'cssClass' => 'conf-steps',
            'halls' => Hall::all()->sortBy("position"),
            'placeTypes' => PlaceType::all()->sortBy("position"),
        ]);
    }
}
