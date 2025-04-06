<p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
<div class="conf-step__legend">
    @foreach($placeTypes as $placeType)
        <span class="conf-step__chair conf-step__chair_{{ $placeType->code }}"></span> — {{ $placeType->name }}
    @endforeach
    <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
</div>
<div class="conf-step__hall">
    <div class="conf-step__hall-wrapper">
        @if(is_array($hall->config))
            @foreach($hall->config as $key => $row)
                <div class="conf-step__row" data-id="{{ $key }}">
                    @foreach($row as $place)
                        <span class="conf-step__chair conf-step__chair_{{ $place['type'] }} js-place" data-id="{{ $place['id'] }}" data-type="{{ $place['type'] }}"></span>
                    @endforeach
                </div>
            @endforeach
        @else
            @for($i = 1; $i <= $hall->rows; $i++)
                <div class="conf-step__row" data-id="{{ $i }}">
                    @for($j = 1; $j <= $hall->places; $j++)
                        <span class="conf-step__chair conf-step__chair_standart js-place" data-id="{{ $j }}" data-type="standart"></span>
                    @endfor
                </div>
            @endfor
        @endif
    </div>
</div>
