<p class="ticket__info">
    На фильм: <span class="ticket__details ticket__title">{{ $movie->title }}</span>
</p>
<p class="ticket__info">
    Места: <span class="ticket__details ticket__chairs">
        @foreach($places as $place)
            {{ $place['place'] }} ({{ $place['row'] }} ряд)@if(!$loop->last),@endif
        @endforeach
    </span>
</p>
<p class="ticket__info">
    В зале: <span class="ticket__details ticket__hall">{{ $hall->name }}</span>
</p>
<p class="ticket__info">
    Начало сеанса: <span class="ticket__details ticket__start">{{ $date }} в {{ $movieSession->movie_session_time }}</span>
</p>
<p class="ticket__info">
    Стоимость: <span class="ticket__details ticket__cost">{{ $sum }}</span> рублей
</p>

<button class="acceptin-button" onclick="location.href='{{ route('ticket', ['id' => $order->id]) }}'" >Получить код бронирования</button>

<p class="ticket__hint">После оплаты билет будет доступен в этом окне, а также придёт вам на почту. Покажите QR-код нашему контроллёру у входа в зал.</p>
<p class="ticket__hint">Приятного просмотра!</p>
