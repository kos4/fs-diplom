<nav class="page-nav">
    @if(!$dates[0]['today'])
        <a class="page-nav__day page-nav__day_prev" href="#"></a>
    @endif

    @foreach($dates as $date)
        <a class="page-nav__day {{ $date['today'] ? 'page-nav__day_today' : '' }} {{ $date['chosen'] ? 'page-nav__day_chosen' : '' }} {{ in_array($date['date']->dayOfWeekIso, [6, 7]) ? 'page-nav__day_weekend' : '' }}" href="#">
            <span class="page-nav__day-week">{{ $date['date']->minDayName }}</span>
            <span class="page-nav__day-number">{{ $date['date']->day }}</span>
        </a>
    @endforeach

    <a class="page-nav__day page-nav__day_next" href="#"></a>
</nav>
