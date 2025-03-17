<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieSessionRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\MovieSession;

class MovieSessionController extends Controller
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
            'form' => view('admin.includes.movieSession.movieSessionForm', [
                'halls' => Hall::all()->sortBy("name"),
                'movies' => Movie::all()->sortBy("title"),
                'hall' => Hall::find(request()->query('hall_id')),
                'movie' => Movie::find(request()->query('movie_id')),
            ])->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieSessionRequest $request)
    {
        $movieSession = MovieSession::create($request->all());

        if ($movieSession->id) {
            return response()->json([
                'success' => true,
                'list' => view('admin.includes.movieSession.movieSessionHalls', ['halls' => Hall::all()->sortBy("position")])->render(),
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
    public function show(MovieSession $movieSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieSession $movieSession)
    {
        return response()->json([
            'success' => true,
            'form' => view('admin.includes.movieSession.movieSessionForm', [
                'movieSession' => $movieSession,
                'halls' => Hall::all()->sortBy("name"),
                'movies' => Movie::all()->sortBy("title"),
                'hall' => Hall::find(request()->query('hall_id')),
                'movie' => Movie::find(request()->query('movie_id')),
            ])->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieSessionRequest $request, MovieSession $movieSession)
    {
        $movieSession->update($request->all());

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.movieSession.movieSessionHalls', ['halls' => Hall::all()->sortBy("position")])->render(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieSession $movieSession)
    {
        $movieSession->delete();

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.movieSession.movieSessionHalls', ['halls' => Hall::all()->sortBy("position")])->render(),
        ]);
    }
}
