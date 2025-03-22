<section class="buying">
    <div class="buying__info">
        <div class="buying__info-description">
            <h2 class="buying__info-title">{{ $movie->title }}</h2>
            <p class="buying__info-start">Начало сеанса: {{ $movieSession->movie_session_time }}</p>
            <p class="buying__info-hall">{{ $hall->name }}</p>
        </div>
        <div class="buying__info-hint">
            <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
    </div>
    <div class="buying-scheme">
        @include('site.includes.hall.configHallPlaces')
        @include('site.includes.hall.pricesHall', ['prices' => $hall->prices])
    </div>
    <button class="acceptin-button" onclick="location.href='{{ route('payment') }}'" >Забронировать</button>
</section>
