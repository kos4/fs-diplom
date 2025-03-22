<div class="buying-scheme__legend">
    <div class="col">
        @foreach($prices as $price)
            <p class="buying-scheme__legend-price">
                <span class="buying-scheme__chair buying-scheme__chair_{{ $price->placeType->code }}"></span>
                Свободно {{ $price->placeType->name }} (<span class="buying-scheme__legend-value">{{ $price->price }}</span>руб)
            </p>
        @endforeach
    </div>
    <div class="col">
        <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
        <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>
    </div>
</div>
