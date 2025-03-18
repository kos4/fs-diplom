<form action="" method="post">
    @csrf
    @isset($hall)
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $hall->id }}">
    @endisset
    <label class="conf-step__label conf-step__label-fullsize" for="name">
        Название зала
        <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required value="{{ isset($hall) ? $hall->name : '' }}">
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="position">
        Позиция
        <input class="conf-step__input" type="number" placeholder="Например, 10" name="position" required value="{{ isset($hall) ? $hall->position : '' }}">
    </label>
    <div class="conf-step__buttons text-center">
        <input type="submit" value="{{ isset($hall) ? 'Обновить зал' : 'Добавить зал' }}" class="conf-step__button conf-step__button-accent">
        <button class="conf-step__button conf-step__button-regular js-popup-close" type="button">Отменить</button>
    </div>
</form>
