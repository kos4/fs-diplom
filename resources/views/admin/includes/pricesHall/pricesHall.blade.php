<input type="hidden" name="id" value="{{ $hall->id }}">
<p class="conf-step__paragraph">Установите цены для типов кресел:</p>

@foreach($placeTypes as $placeType)
    @if($placeType->code === 'disabled')
        @continue
    @endif

    @if($prices->isEmpty())
        @php
            $price = null;
        @endphp
    @else
        @php
            $price = $prices->where('type_id', $placeType->id)->first();
        @endphp
    @endif

    <div class="conf-step__legend" data-priceId="{{ $price ? $price->id : '' }}" data-typeId="{{ $placeType->id }}">
        <label class="conf-step__label">Цена, рублей<input type="number" class="conf-step__input" placeholder="0" required value="{{ $price ? $price->price : '' }}" data-default="{{ $price ? $price->price : '' }}"></label>
        за <span class="conf-step__chair conf-step__chair_{{ $placeType->code }}"></span> {{ $placeType->name }}
    </div>
@endforeach
