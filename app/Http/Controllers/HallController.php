<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;

class HallController extends Controller
{
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
        $hall->update($request->all());

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.halls.hallList', ['halls' => Hall::all()->sortBy("position")])->render(),
        ]);
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
