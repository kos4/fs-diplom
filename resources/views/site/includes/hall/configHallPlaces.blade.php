<div class="buying-scheme__wrapper js-places" data-movie-session="{{ $movieSession->id }}">
    @foreach($hall->config as $row)
        <div class="buying-scheme__row">
            @foreach($row as $place)
                <span class="buying-scheme__chair buying-scheme__chair_{{ $place['type'] }} js-place" data-number="{{ $place['number'] }}" data-type="{{ $place['type'] }}"></span>
            @endforeach
        </div>
    @endforeach
</div>
