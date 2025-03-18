<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\PlaceType;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'pageTitle' => config('APP_NAME'),
            'cssClass' => 'conf-steps',
            'halls' => Hall::all()->sortBy("position"),
            'placeTypes' => PlaceType::all()->sortBy("position"),
            'movies' => Movie::all()->sortBy("position"),
        ]);
    }

    public function openSale(Request $request)
    {
        if (csrf_token() === $request->input('_token')) {
            $openHalls = $request->input('halls');
            $openHallsMessage = [];

            foreach (Hall::all() as $hall) {
                if (is_array($openHalls) && in_array((string)$hall->id, $openHalls, true)) {
                    $hall->update(['is_active' => true]);
                    $openHallsMessage[] = $hall->name;
                } else {
                    $hall->update(['is_active' => false]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => count($openHallsMessage) ? implode(", ", $openHallsMessage) . ' - открыта продажа билетов.' : 'Продажа билетов закрыта.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Доступ запрещен.',
        ]);
    }
}
