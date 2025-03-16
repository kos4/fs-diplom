@isset($movie)
    <div class="popup__poster" style="background-image: url('{{ $movie->posterUrl }}')"></div>
@endisset
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @isset($movie)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $movie->id }}">
    @endisset
    <label class="conf-step__label conf-step__label-fullsize" for="title">
        Название фильма
        <input class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="title" required value="{{ isset($movie) ? $movie->title : '' }}">
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="image">
        Постер
        <input class="conf-step__input" type="file" name="image" accept="image/png, image/jpeg, image/webp">
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="runtime">
        Продолжительность фильма (мин.)
        <input class="conf-step__input" type="number" name="runtime" required value="{{ isset($movie) ? $movie->runtime : '' }}">
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="description">
        Описание фильма
        <textarea class="conf-step__input" type="text" name="description" required>{{ isset($movie) ? $movie->description : '' }}</textarea>
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="country">
        Страна
        <input class="conf-step__input" type="text" name="country" required value="{{ isset($movie) ? $movie->country : '' }}">
    </label>
    <label class="conf-step__label conf-step__label-fullsize" for="position">
        Позиция
        <input class="conf-step__input" type="number" name="position" required value="{{ isset($movie) ? $movie->position : '' }}">
    </label>
    <div class="conf-step__buttons text-center">
        <input type="submit" value="{{ isset($movie) ? 'Обновить фильм' : 'Добавить фильм' }}" class="conf-step__button conf-step__button-accent">
        <button class="conf-step__button conf-step__button-regular js-popup-close" type="button">Отменить</button>
        @isset($movie)
            <button class="conf-step__button conf-step__button-regular js-movie-delete" type="button">Удалить</button>
        @endisset
    </div>
</form>
