<?php

namespace App\Http\Controllers;

use App\Models\Hall;

class AdminController extends Controller
{
    public function index() {
        return view('admin.pages.index', [
            'pageTitle' => config('APP_NAME'),
            'cssClass' => 'conf-steps',
            'halls' => Hall::all()->sortBy("position"),
        ]);
    }
}
