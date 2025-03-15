<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceRequest $request)
    {
        $price = Price::create($request->validated());

        if ($price->id) {
            return response()->json([
                'success' => true,
                'id' => $price->id,
                'type_id' => $price->type_id,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Ошибка сохранения данных.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, Price $price)
    {
        $price->update($request->all());

        return response()->json([
            'success' => true,
        ]);
    }
}
