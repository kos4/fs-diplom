<div class="buying-scheme__wrapper js-places" data-movie-session="{{ $movieSession->id }}">
    @foreach($hall->config as $rowNumber => $row)
        <div class="buying-scheme__row" data-row-number="{{ $loop->index }}">
            @foreach($row as $place)
                <span class="buying-scheme__chair @if($booked && $booked->where('place_number', $place['number'])->where('row_number', $rowNumber)->count()) buying-scheme__chair_taken @else buying-scheme__chair_{{ $place['type'] }} @endif js-place" data-number="{{ $place['number'] }}" data-type="{{ $place['type'] }}"></span>
            @endforeach
        </div>
    @endforeach
</div>
