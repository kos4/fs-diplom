<form action="" method="post">
    @csrf

    @isset($movieSession)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $movieSession->id }}">
    @endisset

    <label class="conf-step__label conf-step__label-fullsize">
        Название зала
        <select class="conf-step__input" name="hall_id" required>
            @foreach($halls as $item)
                <option value="{{ $item->id }}" {{ $item->id === $hall->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
    </label>
    <label class="conf-step__label conf-step__label-fullsize">
        Название фильма
        <select class="conf-step__input" name="movie_id" required>
            @foreach($movies as $item)
                <option value="{{ $item->id }}" {{ $item->id === $movie->id ? 'selected' : '' }}>{{ $item->title }}</option>
            @endforeach
        </select>
    </label>
    <label class="conf-step__label conf-step__label-fullsize">
        Время начала
        <input class="conf-step__input" type="time" value="{{ isset($movieSession) ? $movieSession->movie_session_time : '00:00' }}" name="movie_session_time" required>
    </label>

    <div class="conf-step__buttons text-center">
        <input type="submit" value="{{ isset($movieSession) ? 'Обновить сеанс' : 'Добавить сеанс' }}" class="conf-step__button conf-step__button-accent">
        <button class="conf-step__button conf-step__button-regular js-popup-close" type="button">Отменить</button>
    </div>
</form>
