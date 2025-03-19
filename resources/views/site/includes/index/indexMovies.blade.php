@if($movies)
    @foreach($movies as $movie)
        <section class="movie">
            <div class="movie__info">
                <div class="movie__poster">
                    <img class="movie__poster-image" alt="{{ $movie->title }}" src="{{ $movie->posterUrl }}">
                </div>
                <div class="movie__description">
                    <h2 class="movie__title">{{ $movie->title }}</h2>
                    <p class="movie__synopsis">{{ $movie->description }}</p>
                    <p class="movie__data">
                        <span class="movie__data-duration">{{ $movie->runtime }} минут</span>
                        <span class="movie__data-origin">{{ $movie->country }}</span>
                    </p>
                </div>
            </div>

            @foreach($movie->gatHalls() as $hall)
                <div class="movie-seances__hall">
                    <h3 class="movie-seances__hall-title">{{ $hall->name }}</h3>
                    <ul class="movie-seances__list">
                        @foreach($movie->getMovieSessions($hall->id) as $movieSession)
                            <li class="movie-seances__time-block">
                                <a class="movie-seances__time" href="{{ route('hall', ['movieSessionId' => $movieSession->id]) }}">{{ $movieSession->movie_session_time }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </section>
    @endforeach
@endif
