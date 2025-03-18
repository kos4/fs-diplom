<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieSessionRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\MovieSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $check = $this->checkMovieSession($request->input('hall_id'), $request->input('movie_id'), $request->input('movie_session_time'));

        if ($check['success']) {
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

        return response()->json($check);
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
        $check = $this->checkMovieSession($request->input('hall_id'), $request->input('movie_id'), $request->input('movie_session_time'));

        if ($check['success']) {
            $movieSession->update($request->all());

            return response()->json([
                'success' => true,
                'list' => view('admin.includes.movieSession.movieSessionHalls', ['halls' => Hall::all()->sortBy("position")])->render(),
            ]);
        }

        return response()->json($check);
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

    private function checkMovieSession($hall_id, $movie_id, $movie_session_time)
    {
        $result = [
            'success' => true,
            'message' => "",
        ];
        $movie = Movie::find($movie_id);

        $prevMovie = DB::table('movie_sessions as ms')
            ->leftJoin('movies as m', 'm.id', '=', 'ms.movie_id')
            ->select('m.runtime as runtime', 'ms.movie_session_time as movie_session_time')
            ->where('ms.hall_id', '=', $hall_id)
            ->where('ms.movie_session_time', '<=', $movie_session_time)
            ->orderBy('ms.movie_session_time', 'desc')
            ->limit(1)
            ->get()->first();

        if ($prevMovie) {
            $prevTime = Carbon::parse($prevMovie->movie_session_time)->addMinutes($prevMovie->runtime);
            $startTime = Carbon::parse($movie_session_time);

            if ($prevTime > $startTime) {
                $result['success'] = false;
                $result['message'] = 'Добавляемый сеанс накладывается на предыдущий.<br>';
            }
        }

        $nextMovie = DB::table('movie_sessions')
            ->where('hall_id', '=', $hall_id)
            ->where('movie_session_time', '>=', $movie_session_time)
            ->orderBy('movie_session_time')
            ->limit(1)
            ->get()->first();

        if ($nextMovie) {
            $nextTime = Carbon::parse($nextMovie->movie_session_time);
            $endTime = Carbon::parse($movie_session_time)->addMinutes($movie->runtime);

            if ($endTime > $nextTime) {
                $result['success'] = false;
                $result['message'] .= 'Добавляемый сеанс накладывается на следующий сеанс.<br>';
            }
        }

        return $result;
    }
}
