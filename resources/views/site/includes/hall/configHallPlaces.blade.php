<div class="buying-scheme__wrapper js-places" data-movie-session="{{ $movieSession->id }}">
    @if(is_array($hall->config))
        @foreach($hall->config as $rowNumber => $row)
            <div class="buying-scheme__row" data-row-number="{{ $rowNumber }}">
                @if(is_array($row))
                    @foreach($row as $place)
                        @php
                            $taken = ($booked && $booked->where('place_number', $place['number'])->where('row_number', $rowNumber)->count());
                        @endphp
                        <span
                            class="buying-scheme__chair @if($taken) buying-scheme__chair_taken @else buying-scheme__chair_{{ $place['type'] }} @endif js-place"
                            data-number="{{ $place['number'] }}" data-type="{{ $place['type'] }}" data-taken="{{ $taken }}"></span>
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>
