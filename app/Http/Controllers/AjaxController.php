<?php

namespace App\Http\Controllers;

use App\Dates;
use App\Models\Basket;
use App\Models\MovieSession;
use App\Models\Order;
use App\Models\PlaceType;
use Illuminate\Support\Carbon;
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

    public function saveOrder(Request $request) {
        $dataDate = Dates::getSelectedDate();
        $dataOrder = json_decode($request->input('order'));

        if ($dataOrder->items) {
            $movieSession = MovieSession::find($dataOrder->movieSession);
            $hall = $movieSession->hall;
            $prices = $hall->prices;
            $sum = 0;
            $places = [];
            $placeTypes = PlaceType::all();

            $order = Order::create([
                'date' => $dataDate->toDateString(),
                'movie_session_id' => $dataOrder->movieSession,
                'qr_code' => '',
            ]);

            foreach ($dataOrder->items as $item) {
                $placeTypeId = $placeTypes->where('code', $item->type)->first()->id;
                $price = $prices->where('type_id', $placeTypeId)->first()->price;
                $sum += $price;
                $places[] = [
                    'row' => $item->row,
                    'place' => $item->number,
                ];
                Basket::create([
                    'order_id' => $order->id,
                    'row_number' => $item->row,
                    'place_number' => $item->number,
                    'place_type_id' => $placeTypeId,
                    'price' => $price,
                ]);
            }

            return response()->json([
                'html' => view('site.includes.payment.orderPayment', [
                    'movie' => $movieSession->movie,
                    'hall' => $hall,
                    'movieSession' => $movieSession,
                    'sum' => $sum,
                    'order' => $order,
                    'places' => $places,
                    'date' => $dataDate->isoFormat('D MMMM YYYY г.')
                ])->render(),
            ]);
        }

    }
}
