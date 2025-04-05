<input type="hidden" name="id" value="{{ $hall->id }}">
<p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
<div class="conf-step__legend">
    <label class="conf-step__label">Рядов, шт<input type="number" class="conf-step__input" min="1" required placeholder="10" name="rows" value="{{ $hall->rows }}"></label>
    <span class="multiplier">x</span>
    <label class="conf-step__label">Мест, шт<input type="number" class="conf-step__input" min="1" required placeholder="8" name="places" value="{{ $hall->places }}" ></label>
</div>

@if($hall->rows && $hall->places)
    @include('admin.includes.configHall.configHallPlaces')
@endif
