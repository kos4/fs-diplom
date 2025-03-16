@if ($movies)
    @foreach ($movies as $movie)
        <div class="conf-step__movie js-movie" data-id="{{ $movie->id }}">
            <img class="conf-step__movie-poster" alt="poster" src="{{ $movie->posterUrl }}">
            <h3 class="conf-step__movie-title">{{ $movie->title }}</h3>
            <p class="conf-step__movie-duration">{{ $movie->runtime }} минут</p>
        </div>
    @endforeach
@endif
