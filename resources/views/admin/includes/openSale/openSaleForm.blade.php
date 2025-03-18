<form action="" method="post">
    @csrf

    @foreach($halls as $hall)
        <label class="conf-step__label conf-step__label-fullsize">
            <input class="conf-step__checkbox" type="checkbox" name="halls[]" value="{{ $hall->id }}" {{ $hall->is_active ? 'checked' : '' }}>
            {{ $hall->name }}
        </label>
    @endforeach

    <div class="conf-step__buttons text-center">
        <input type="submit" value="Открыть продажи" class="conf-step__button conf-step__button-accent">
        <button class="conf-step__button conf-step__button-regular js-popup-close" type="button">Отменить</button>
    </div>
</form>
