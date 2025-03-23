<section class="ticket">

    <header class="tichet__check">
        <h2 class="ticket__check-title">Электронный билет</h2>
    </header>

    <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{ $movie->title }}</span></p>
        <p class="ticket__info">
            Места:
            <span class="ticket__details ticket__chairs">
                @foreach($places as $place)
                    {{ $place['place'] }} ({{ $place['row'] }} ряд)@if(!$loop->last),@endif
                @endforeach
            </span>
        </p>
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{ $hall->name }}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{ $date }} в {{ $movieSession->movie_session_time }}</span></p>

        <img class="ticket__info-qr" src="{{ $qrCode }}">

        <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
    </div>
</section>
