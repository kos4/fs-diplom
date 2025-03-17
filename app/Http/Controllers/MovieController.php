<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Hall;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
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
            'form' => view('admin.includes.movies.movieForm')->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $movie = Movie::create($this->replaceImage($request));

        if ($movie->id) {
            return response()->json([
                'success' => true,
                'list' => view('admin.includes.movies.movieList', ['movies' => Movie::all()->sortBy("position")])->render(),
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
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return response()->json([
            'success' => true,
            'form' => view('admin.includes.movies.movieForm', ['movie' => $movie])->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($this->replaceImage($request, $movie));

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.movies.movieList', ['movies' => Movie::all()->sortBy("position")])->render(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $this->deletePoster($movie);
        $movie->delete();

        return response()->json([
            'success' => true,
            'list' => view('admin.includes.movies.movieList', ['movies' => Movie::all()->sortBy("position")])->render(),
            'halls' => view('admin.includes.movieSession.movieSessionHalls', ['halls' => Hall::all()->sortBy("position")])->render(),
        ]);
    }

    private function replaceImage(MovieRequest $request, Movie $movie = null)
    {
        if ($request->hasFile('image')) {
            if(!Storage::disk('public')->exists('posters')){
                Storage::disk('public')->makeDirectory('posters');
            }

            if ($movie) {
                $this->deletePoster($movie);
            }

            $posterName = time() . '.' . $request->image->extension();
            $request->image->storeAs('posters', $posterName, 'public');
            $request->merge(['poster' => $posterName]);
            $data = $request->except(['image']);
        } else {
            $data = $request->all();
        }

        return $data;
    }

    private function deletePoster(Movie $movie)
    {
        Storage::disk('public')->delete('posters/' . $movie->poster);
    }
}
