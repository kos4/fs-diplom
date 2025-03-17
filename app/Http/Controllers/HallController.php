<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
use App\Models\PlaceType;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'success' => true,
            'form' => view('admin.includes.halls.hallForm')->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request)
    {
        $hall = Hall::create($request->validated());

        if ($hall->id) {
            return response()->json([
                'success' => true,
                'list' => view('admin.includes.halls.hallList', ['halls' => Hall::all()->sortBy("position")])->render(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Ошибка сохранения данных.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        if ($hall->exists) {
            if (request()->query('from') === 'prices') {
                return response()->json([
                    'success' => true,
                    'hall' => view('admin.includes.pricesHall.pricesHall', [
                        'hall' => $hall,
                        'placeTypes' => PlaceType::all()->sortBy("position"),
                        'prices' => $hall->prices,
                    ])->render(),
                ]);
            }

            return response()->json([
                'success' => true,
                'hall' => view('admin.includes.configHall.configHall', [
                    'hall' => $hall,
                    'placeTypes' => PlaceType::all()->sortBy("position"),
                ])->render(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Элемент не найден.',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        return response()->json([
            'success' => true,
            'form' => view('admin.includes.halls.hallForm', ['hall' => $hall])->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, Hall $hall)
    {
        if ($request->has('config')) {
            $request->merge(['config' => json_decode($request->input('config'), true)]);
        }

        $hall->update($request->all());
        $json = [
            'success' => true,
        ];

        if ($request->input('getConfig')) {
            $json['hall'] = view('admin.includes.configHall.configHall', [
                'hall' => Hall::find($hall->id),
                'placeTypes' => PlaceType::all()->sortBy("position"),
            ])->render();
        } else {
            $json['list'] = view('admin.includes.halls.hallList', ['halls' => Hall::all()->sortBy("position")])->render();
        }

        return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.halls.hallList', ['halls' => Hall::all()->sortBy("position")])->render(),
        ]);
    }
}
